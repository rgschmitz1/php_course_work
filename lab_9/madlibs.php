<?php
    require_once('connectvars.php');
    class Madlib
    {
        private $noun;
        private $verb;
        private $adjective;
        private $adverb;
        private $story;

        private function dbquery($query) {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or die('Error connecting to MySQL server.');
            $result = mysqli_query($dbc, $query)
                or die('Error querying database');
            # Close database connection
            mysqli_close($dbc);
            return $result;
        }

        public function displaystory() {
            $query = "SELECT Story FROM Madlibs ORDER BY id DESC";
            $result = $this->dbquery($query);
                while ($row = mysqli_fetch_array($result)) {
                    echo '<p>' . $row['Story'] . '</p><hr>';
                }
        }

        private function getnoun() {
            return $this->noun;
        }
        private function getverb() {
            return $this->verb;
        }
        private function getadjective() {
            return $this->adjective;
        }
        private function getadverb() {
            return $this->adverb;
        }
        private function getstory() {
            return $this->story;
        }

        public function storeinputs() {
            # Fetch all variables
            $noun = $this->getnoun();
            $verb = $this->getverb();
            $adjective = $this->getadjective();
            $adverb = $this->getadverb();
            $story = $this->getstory();
            # Create database query
            $query = "INSERT INTO Madlibs (Noun, Verb, Adjective, Adverb, Story) " .
                "VALUES ('$noun', '$verb', '$adjective', '$adverb', '$story')";
            # Execute database query
            $this->dbquery($query);
        }

        public function createstory() {
            $noun = $this->getnoun();
            $verb = $this->getverb();
            $adjective = $this->getadjective();
            $adverb = $this->getadverb();
            $story = "The $adjective fox $adverb $verb over the lazy brown $noun.";
            $this->story = $story;
        }

        public function setnoun($input) {
            $this->noun = $input;
        }
        public function setverb($input) {
            $this->verb = $input;
        }
        public function setadjective($input) {
            $this->adjective = $input;
        }
        public function setadverb($input) {
            $this->adverb = $input;
        }
    }
?>
