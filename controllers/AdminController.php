<?php

/**
 * Контроллер AdminController
 */
class AdminController extends AdminBase
{

    /**
     * Action для главной страницы админ панели
     * @return bool
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Подключаем вид
        require_once (ROOT . '/views/admin/index.php');
        return true;
    }

    /**
     * Страница авторизации в админ панель
     * @return bool
     */
    public function actionLogin()
    {
        // Проверяем, авторизован ли пользователь
        $userId = User::checkLogged();

        if (User::checkRole($userId)) {
            // Если у пользователя роль админ или редактор, то продолжаем

            $login = '';
            $password = '';

            if (isset($_POST['submit'])) {
                // Считываем данные с формы
                $login = $_POST['login'];
                $password = $_POST['password'];

                $errors = false;

                // Проверяем данные для входа
                $getUserId = User::checkUserDataAdminPanel($login, $password);

                if ($getUserId == false) {
                    // Если данные не верны, выводим ошибку
                    $errors[] = 'Неправильный логин или пароль';
                } else {
                    // Если данные правильные, то запоминаем пользователя
                    User::authAdminPanel($getUserId);

                    // Перенаправляем в админ панель
                    header('Location: /admin/');
                }
            }

            // Подключаем вид
            require_once (ROOT . '/views/admin/login.php');
            return true;

        } else {
            header('Location: /');
            return false;
        }
    }

    /**
     * Страница поиска в админ панели
     * @return bool
     */
    public function actionSearch()
    {
        if (isset($_POST['query'])) {
            // Если запрос был отправлен, считываем с какой страницы был запрос и определяем метод для поиска
            $url = $_SERVER['HTTP_REFERER'];

            if (strpos($url, 'collection') !== false) {
                $query = '%' . $_POST['query'] . '%';
                Collection::searchCollectionInAdminPanel($query);

            } elseif (strpos($url, 'user') !== false) {
                $query = '%' . $_POST['query'] . '%';
                User::searchUserInAdminPanel($query);

            } elseif (strpos($url, 'order') !== false) {
                $query = '%' . $_POST['query'] . '%';
                Order::searchOrderInAdminPanel($query);

            } elseif (strpos($url, 'ticket') !== false) {
                $query = '%' . $_POST['query'] . '%';
                Tickets::searchTicketInAdminPanel($query);

            } elseif (strpos($url, 'category') !== false) {
                $query = '%' . $_POST['query'] . '%';
                Category::searchCategoryInAdminPanel($query);
            }
        }

        return true;
    }
}