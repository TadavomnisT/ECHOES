<?php

$content = explode(
    "---------------------------------------------------------------------",
    file_get_contents( "Result" )
);

foreach ($content as $key => $value) {
    if (strpos( $value, "Simulation started" ) === false) {
        unset($content[$key]);
    }
}
$content = array_values( $content );

foreach ($content as $key => $value) {
    $name = trim( explode( PHP_EOL, explode( "Assign method is :" , $value )[1] )[0] );
    $lines = "";
    foreach (explode(PHP_EOL, trim($value)  ) as $line) {
        if (strpos( $line, "Task(s) still waiting." ) !== false) {
            $lines .= trim( explode( ")", explode( "seconds passed," , $line )[0] )[1] ) .
            "," .
            trim( explode( "\" Successfully terminated Task(s)", explode( "Total terminated Task(s) so far, \"" , $line )[1] )[0] ) .
            "," .
            trim( explode( "\" Task(s) running at this point", explode( "Expired terminated Task(s), \"" , $line )[1] )[0] ) .
            PHP_EOL;
        }
    }
    file_put_contents( $name, trim($lines) );
}



?> 
