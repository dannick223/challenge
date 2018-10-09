<?php
/**
 *
* How to parce html:
* $master = new Template("template/master.tpl");
* $master->set('test', 'Body of test');
* echo $master->output();
* NOTE: Now you can use {{test} on master.tpl and then the index.php would have the value echoed

* How to include parced html from different template to master:
* $master = new Template("template/master.tpl");
* $simple = new Template("template/simp.tpl");
* $simple->set('simplified', 'I am a simplified example');
* $master->set('h1', $simple->output()); // notice the use of the $master
* echo $master->output();
* NOTE: Now you can use {{h1}} on master.tpl and get the value of {{simplified}} from simp.tpl
 */

//NOTE: The reason for having the html template in a seperate file is because the php file_get_contents
//  also graps the php which is clearly unwanted and not safe. so a pure html file is the safest route.


    class Parce
    {
        protected $_file; // template html filename.
        protected $_openTag = "{{"; // change the delimiter to whatever.
        protected $_closeTag = "}}";
        protected $_values = []; // contains all the keys and values.
        public function __construct($file)
        {
            $this->_file = $file;
        }

        // Method used to set the $key and value in the protected $values array
        public function set($key, $value)
        {
            $this->_values[$key] = $value;
        }

        // Check if the Template file exists
        // Read contents of $this->file (the html template)
        // make a loop replacing everything with {{ }} around it with the matched value.
        // returns the replaced html.
        public function output()
        {
            if (!file_exists($this->_file)) {
                return "Cant find ($this->_file).<br>";
            }
            $output = file_get_contents($this->_file);
            foreach ($this->_values as $key => $value) {
                $replace = $this->_openTag . $key . $this->_closeTag;
                $output = str_replace($replace, $value, $output);
            }
            return $output;
        }

        // Loops through each Template object, chains them together and puts a seperator between them.
        // It expects an array of Template objects if anything else is given it returns an error.
        // returns an output of the merged arrays with  seperator.
        // shorthand if else to store data in a variable.
        public static function merge($templates)
        {
            $output = "";
            foreach ($templates as $template) {
                $cont = (get_class($template) !== "Parce")
                  ? "Error, expected Template. <br>"
                  : $template->output();
                $output .= $cont;
            }
            return $output;
        }
    }
