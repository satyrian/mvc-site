<?php

class News
{

    const SHOW_BY_DEFAULT = 6;

    /**
     * Возвращает одну новость по id
     * @param $id
     * @return mixed
     */
    public static function getNewsItemById($id)
    {
        $db = Db::getConnection();

        // Используем подготовленный запрос
        $sql = 'SELECT * FROM news WHERE id = :id';

        // Подготавливаем запрос
        $result = $db->prepare($sql);
        // Привязываем параметры
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Выполняем запрос
        $result->execute();

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Извлекаем и возвращаем
        return $result->fetch();
    }

    /**
     * Возвращаем список новостей
     * @param $page
     * @return array
     */
    public static function getNewsList($page)
    {
        $page = intval($page);
        $limit = self::SHOW_BY_DEFAULT;
        // Считаем сдвиг для запроса
        $offset = ($page - 1) * $limit;

        $db = Db::getConnection();

        // Используем подготовленный запрос
        $sql = 'SELECT id, title, short_content '
            . 'FROM news WHERE status="1" '
            . 'ORDER BY date DESC '
            . 'LIMIT :limit OFFSET :offset';

        // Подготавливаем запрос к выполнению
        $result = $db->prepare($sql);
        // Привязываем параметры
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        // Выполняем запрос
        $result->execute();

        $newsList = array();
        $i = 0;
        // Получаем данные в виде массива
        while ($row = $result->fetch()) {
            $newsList [$i]['id'] = $row['id'];
            $newsList [$i]['title'] = $row['title'];
            $newsList [$i]['short_content'] = $row['short_content'];
            $i++;
        }

        // Возвращаем массив
        return $newsList;
    }

    /**
     * Возвращаем новости для слайдера
     * @return array
     */
    public static function getNewsListForSlider()
    {
        $db = Db::getConnection();

        // Выполняем запрос
        $result = $db->query('SELECT id, title, short_content 
        FROM news WHERE status="1" ORDER BY date DESC LIMIT 5');

        $newsList = array();
        $i = 0;
        // Получаем данные в виде массива
        while($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $i++;
        }

        // Возвращаем
        return $newsList;
    }

    /**
     * Возвращаем общее количество новостей, где статус = 1
     * @return mixed
     */
    public static function getNewsCount()
    {
        $db = Db::getConnection();

        // Выполняем запрос
        $result = $db->query('SELECT count(id) as count FROM news WHERE status="1"');

        // Получаем и возвращаем
        $row = $result->fetch();
        return $row['count'];
    }

    /**
     * Возвращаем путь до изображения
     * @param $id
     * @return string
     */
    public static function getImage($id)
    {
        // Название для заглушки
        $noImage = 'no-image.png';
        // Путь до папки
        $path = '/upload/images/news';

        // Путь до картинки новости
        $pathToImage =  $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToImage)) {
            // Если есть такой файл, то возвращаем путь
            return $pathToImage;
        }

        // Если нет, то возвращаем заглушку
        return $path . $noImage;
    }

    /**
     * Возвращаем текстовое пояснение статусу
     * @param $status
     * @return string
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыто';
                break;
        }
    }
}