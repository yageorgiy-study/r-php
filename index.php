<?php
// TODO: sanitize input (?)

class Task1 {

    public string $filename = "./results.txt";
    public string $contents;

    /**
     * @param string $filename
     * @param string $contents
     */
    public function __construct(string $filename, string $contents)
    {
        $this->filename = $filename;
        $this->contents = $contents;
    }


    public function process(){
        $contents = $this->contents;
        $jsonAssoc = json_decode($contents, true);
        $output = [];

        foreach($jsonAssoc as $item){
            $output[$item["category"]][] = [
                "id" => $item["id"]
            ];
        }

        file_put_contents($this->filename, json_encode($output));
    }
};

(new Task1("./results.txt", file_get_contents("php://stdin")))->process();