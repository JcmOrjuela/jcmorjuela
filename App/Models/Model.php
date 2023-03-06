<?php

namespace App\Models;

class Model
{
    protected $path;
    protected $content;
    protected $child;

    public function __construct()
    {
        $this->child = get_called_class();
        $className = str_replace(__NAMESPACE__ . '\\', '', $this->child);
        $table = camelCaseToSnakeCase($className);
        $table = singularToPlural($table);

        $this->path = dirname(__DIR__, 2) . "/Database/{$table}.json";

        if (file_exists($this->path)) {
            $this->getUpdatedContent();
        }
    }

    public function create(array $data)
    {
        $this->getUpdatedContent();
        $this->content[] = $data;

        $this->putContent();
    }

    public function read($id)
    {
        $this->getUpdatedContent();

        return $this->fillChild($this->content[$id]);
    }

    public function update($id)
    {
    }

    public function delete($id)
    {
        $this->getUpdatedContent();
        unset($this->content[$id]);
        $this->putContent();
    }

    public function all()
    {
        $this->getUpdatedContent();
        $result = [];
        foreach ($this->content as $data) {
            $result[] = $this->fillChild($data);
        }

        return $result;
    }


    public function search(string $needle, string $field)
    {
        $this->getUpdatedContent();
        $data = array_filter($this->content, function ($register) use ($needle, $field) {
            return $needle == $register[$field];
        });

        $data = reset($data);

        return $this->fillChild(($data) ? $data : []);
    }

    private function getUpdatedContent()
    {
        $this->content = toArray(file_get_contents($this->path));
    }
    public function getContent()
    {
        return $this->content;
    }

    private function putContent()
    {
        $this->content = array_values($this->content);
        file_put_contents($this->path, json_encode($this->content));
    }

    private function fillChild(array $data)
    {
        $instance = new $this->child;

        if (!empty($data)) {
            foreach ($instance->fillable as $field) {
                $set = "set{$field}";
                $instance->{$set}($data[$field]);
            }
        }

        return $instance;
    }
}
