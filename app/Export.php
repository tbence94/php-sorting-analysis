<?php

namespace App;

class Export
{
    /**
     * Path of template file
     */
    const TEMPLATE = 'app/template.php';

    /**
     * Store processed results to export
     *
     * @var array
     */
    private $data;

    /**
     * Get data to export
     *
     * @param array &$data
     */
    public function __construct(array &$data)
    {
        $this->data = $this->process($data);
    }

    /**
     * Change data format for google charts
     *
     * @param  array  &$data
     * @return void
     */
    private function process(array &$data)
    {
        reset($data);
        $cols = array_keys(current($data));

        $output = [$cols];

        if (count($data)>100) {
            $data = array_column($this->chunk($data, 100), 0);
        }

        foreach ($data as $n => $results) {
            $row = [];
            foreach ($results as $algorithm => $iterations) {
                $row[] = $iterations;
            }
            $output[] = $row;
        }

        return $output;
    }

    /**
     * This method helps to create a given amount of chunks from an array
     *
     * @param  array  &$data
     * @param  int    $chunks
     * @return array
     */
    private function chunk(array &$data, int $chunks)
    {
        if (sizeof($data) > 0) {
            return array_chunk($data, intval(ceil(count($data) / $chunks)));
        }
    }

    /**
     * Insert data to the template and export to file
     *
     * @param  string $file
     * @return void
     */
    public function saveTo(string $file)
    {
        $results = json_encode($this->data);
        
        ob_start();
        require_once self::TEMPLATE;
        $report = ob_get_clean();

        file_put_contents($file, $report);
    }
}
