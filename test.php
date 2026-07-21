<?php
function hello(){
    echo "hello";
}
function bye(){
    echo"bye";}
function excute($job){
    $job();

}
excute('hello');
excute('bye');