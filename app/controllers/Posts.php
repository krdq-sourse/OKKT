<?php

namespace app\controllers;
class Posts
{

    public function indexAction()
    {
        echo "ну бля, это контроллер".' '.__CLASS__;
    }
    public function testAction()
    {
        echo "<table>";
        for ($i = 0; $i<100;$i++)
        {
            if($i%5==0)
                echo "<tr>";
            echo "<td>$i</td>";
            if($i%10==0)
                echo "</tr>";
        }
        echo "</table>";
    }


}