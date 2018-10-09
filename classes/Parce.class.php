<?php
/**
* How to parce html:
* $master = new Template("template/master.tpl");
* $master->stage('test', 'Body of test');
* echo $master->output();
* Now you can use {{test} on master.tpl and then the index.php would have the value printed

* How to include parced html from different template to master:
* $master = new Template("template/master.tpl");
* $simple = new Template("template/simp.tpl");
* $simple->stage('simplified', 'I am a simplified example');
* $master->stage('h1', $simple->output()); // notice the use of the $master
* echo $master->output();
* Now you can use {{h1}} on master.tpl and get the value of {{simplified}} from simp.tpl
* The reason for having the html template in a seperate file is because the php file_get_contents
* also graps the php which is clearly unwanted and not safe. so a pure html file is the safest route.
*  * @author     Daniel Sørensen - <d_soerensen@icloud.com>
*/
/**
 * [Class used to parce html]
 */
    class Parce
    {
        protected $_file;           // html template filename.
        protected $_openTag = "{{"; // chosen the delimiter feel free to edit
        protected $_closeTag = "}}";
        protected $_values = [];    // contains all the keys and values.
        public function __construct($file)
        {
            $this->_file = $file;
        }

        /**
         * Method used to fill the protected $values with $key and value
         * @param [string] $key
         * @param [string] $value
         */
        public function stage($key, $value)
        {
            $this->_values[$key] = $value;
        }

        /**
         * [Reads html template file and loops through the array to replace the $key with the arrays value.]
         * @return [string] [returns the value of the array with matching $key]
         */
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

        /**
         * Loops through each supplied array of objects and chains them together
         * places the data from the array into a string and then it is returned.
         * @param  [array] $objects
         * @return [string] [Returns the data from the supplied array of objects as string]
         */
        public static function chain($objects)
        {
            $output = "";
            foreach ($objects as $object) {   // Loop through array of objects
                $output .= $object->output(); // add data to string
            }
            return $output;                   // returns the string
        }
    }
