<?php

include PATH . '/application/helpers/common_helper.php';

class Users extends BaseController {

    private $_mdusers;
    private $_view;

    public function __construct() {
        $this->_mdusers = new mdusers();
        $this->_view = new BaseView();
    }

    public function index() {
        $this->login();
    }

    /**
     * Action which loads login form
     */
    public function login() {
        $this->_view->generate('login');
    }

    /**
     * Login action
     * INPUT
     *      POST string email - user email
     *      POST string password - user password
     * OUTPUT
     *      view profile for user
     *      view admin panel for admin
     */
    public function do_login() {
        session_start();
        if (empty($_POST['email']) && empty($_POST['password'])) {
            sendError(['email' => 'You did not fill all fields']);
        }
        $email = htmlspecialchars($_POST['email']);
        $password = md5($_POST['password']);
        $user = $this->_mdusers->getUserForAuthorization($email, $password);
        if (!$user) {
            sendError(['email' => 'Not a valid email or password']);
        }
        if ($user->getAccess() === 0) {
            sendError(['email' => 'You did not activate your account']);
        }
        $_SESSION['session_username'] = $user->getEmail();
        if ($user->getLevel() == ILevelEnum::LEVEL_USER) {
            header('Location: /users/profile');
        } else {
            header('Location: /users/admin_panel');

        }
    }

    /**
     * Admin panel action
     */
    public function admin_panel() {
        session_start();
        if (!isset($_SESSION["session_username"])) {
            $this->_view->generate('login');
        }
        $user = $this->_mdusers->getUserByEmail($_SESSION["session_username"]);
        if ($user->getLevel() != ILevelEnum::LEVEL_ADMIN) {
            sendError(['text' => 'You do not have access to this page']);
        }
        $allUsers = $this->_mdusers->getAllUsers();
        require_once(PATH . '/application/views/admin_panel.php');
    }

    /**
     * User profile action
     */
    public function profile() {
        session_start();
        if (!isset($_SESSION["session_username"])) {
            $this->_view->generate('login');
        }
        $user = $this->_mdusers->getUserByEmail($_SESSION["session_username"]);
        require_once(PATH . '/application/views/profile.php');
    }

    /**
     * Registration action
     */
    public function registration() {
        $this->_view->generate('registration');
    }

    /**
     * Add new user action
     *  INPUT
     *      POST string password - user password
     *      POST string email - user email
     * OUTPUT
     *  in error case http code status 500
     *      array with validation errors
     *          [
     *           password,
     *           email
     *          ]
     *   in success load active user view
     */
    public function add_user() {
        $email = filterPost($_POST['email']);
        $passwordHash = md5(filterPost($_POST['password']));
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            sendError(['email' => 'Wrong email address']);
        }
        $code = createCodeFromEmail($email);

        $user = DBUsers::factory($_POST);
        $user->setPassword($passwordHash);
        $user->setAccess(0);
        $user->setLevel(ILevelEnum::LEVEL_USER);
        $user->setRegistrationDate(time());
        $user->setCode($code);

        $result = $this->_mdusers->addUser($user);
        if (!$result) {
            sendError(['email' => 'This email is already taken']);
        }
        require_once(PATH . '/application/views/active_user.php');
    }

    /**
     * Activate user action
     *  note: in error case return 404 page
     */
    public function activate_user() {
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', $uri_path);
        $code = $uri_segments[3];
        $user = $this->_mdusers->getUserByCode($code);
        if (!$user) {
            $this->_view->generate('error_404');
        }
        $user->setAccess(1);
        $user->setCode('');
        $this->_mdusers->accessUser($user);
        $this->_view->generate('registration_done');
    }

    /**
     * Logout action
     */
    public function logout() {
        session_start();
        unset($_SESSION['session_username']);
        session_destroy();
        $this->_view->generate('login');
    }

    /**
     * Edit user action
     *  INPUT
     *      POST string table - name table in db
     *      POST string field - name field in db
     *      POST string id - id in change field
     *      POST string value - value
     * OUTPUT
     *  load admin panel
     */
    public function edit_user() {
        if ($_POST) {
            $table = $_POST['table'];
            $field = $_POST['field'];
            $id = $_POST['id'];
            $value = $_POST['value'];
            $this->_mdusers->updateUser($table, $field, $id, $value);
        }
        header('Location: /users/admin_panel');
    }
}