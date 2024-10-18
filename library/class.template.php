<?php
    class template
    {
        private $template;
		private $path;

        function __construct($path,$template = "index.php")
        {
			$this->path = $path;
            if (isset($template))
            {
				$this->template = $template;
                $this->load();
				$this->publish();
            }
        }

        public function load()
        {
			if(!file_exists($this->path."/".$this->template))
			{
				//$this->template = "404.php";
                header("Location: ../Havelock");
                exit();
			}
			else
            {
                $this->template = $this->template;
            }
        }

        public function publish()
        {
            include($this->path."/".$this->template);
        }
    }
?>