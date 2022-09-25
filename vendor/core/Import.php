<?php

namespace Core;

use PhpOffice\PhpSpreadsheet\IOFactory;

class Import
{
    static private $tableName = "";

    static public function table($tableName = "")
    {
        self::$tableName = $tableName;
        return new static;
    }

    static public function render($fileUpload = '')
    {
        $columnTable = Database::table(self::$tableName)->describe();

        $columns = [];

        foreach ($columnTable as $key => $value) {
            $columns[$key] = $value['Field'];
        }

        unset($columns[0]);
        $columns = array_values($columns);
     
        if ( isset($_POST['upload']) ) {
            $fileName = $_FILES[$fileUpload]['name'];
            $file_ext = pathinfo( $fileName, PATHINFO_EXTENSION );

            $allowed_ext = array( "xls", "csv", "xlsx" );
            if ( in_array( $file_ext, $allowed_ext )) {
                $inputFileNamePath = $_FILES[$fileUpload]['tmp_name'];
                
                $speadsheet = IOFactory::load($inputFileNamePath);
                $data = $speadsheet->getActiveSheet()->toArray();

                $fieldStr = "";

                foreach ($columns as $key => $column) {
                    $fieldStr .= $column .", ";
                }

                $fieldStr = trim( $fieldStr , ", " );
              
                if($data[0] == $columns){
                    unset($data[0]);
                    foreach ($data as $row) {
                        $valueStr = "";

                        for ( $i = 0; $i < count($row); $i++ ) { 
                            $valueStr .= "'". $row[ $i ] . "', " ;
                        }

                        $valueStr = trim( $valueStr, ", ");
                        $sql = "INSERT INTO " . self::$tableName . " ( $fieldStr ) VALUES ( $valueStr )";
                        (new Database())->query($sql);
                    }
                    self::callback( "Successfully Imported." );
                }
                self::callback( "Not found field." );
            }else{
                self::callback( "Please upload xls, csv, xlsx file." );
            }
        }
        self::callback( "Not Imported." );
    }

    public static function callback( $message ) {
        Session::data( "import_message", $message );
        return redirect(Session::flash("callback"));
    }
}
