<?php

namespace Base;

class Migrations
{
    private function _getMigrationFiles()
    {
        // Получаем список всех sql-файлов
        $allFiles = glob('database/*.sql');

        // Проверяем, есть ли таблица versions
        \ORM::raw_execute('SHOW TABLES FROM mvc LIKE \'versions\'');

        // Если первая миграция, возвращаем все файлы из папки sql
        if (!\ORM::get_last_statement()->fetch()) {
            return $allFiles;
        }

        // Ищем уже существующие миграции
        $versionsFiles = [];
        // Выбираем из таблицы versions все названия файлов
        $data = \ORM::for_table('versions')->select('name')->find_many();
        // Загоняем названия в массив $versionsFiles
        foreach ($data as $row) {
            array_push($versionsFiles, 'database/' . $row['name']);
        }

        // Возвращаем файлы, которых еще нет в таблице versions
        return array_diff($allFiles, $versionsFiles);
    }

    private function _migrate($file)
    {
        // Выполняем sql-запросы из файла
        $sql = file_get_contents($file);
        \ORM::raw_execute($sql);

        // Вытаскиваем имя файла, отбросив путь
        $baseName = basename($file);
        // Выполняем запрос для добавления миграции в таблицу versions
        $migrate = \ORM::for_table('versions')->create();
        $migrate->name = $baseName;
        $migrate->save();
    }

    public function start()
    {
        // Стартуем
        // Получаем список файлов для миграций за исключением тех, которые уже есть в таблице versions
        $files = $this->_getMigrationFiles();

        // Проверяем, есть ли новые миграции
        if (empty($files)) {
            return false;
        } else {
            // Накатываем миграцию для каждого файла
            foreach ($files as $file) {
                $this->_migrate($file);
            }
        }
    }
}