<?php
 
 require '../config/function.php';

 $paramResultId = checkParamId('id');
 if(is_numeric($paramResultId)){

    $categoryId = validate($paramResultId);

    $category = getById('categories', $categoryId);

    if($category['status'] == 200){
        $response = delete('categories', $categoryId);
        if($response){
            redirect('categories.php','Delete category Success');
        }else{
            redirect('categories.php','Delete category Fail');
        }
    }else{
        redirect('categories.php',$category['message']);
    }
 }else{
    redirect('categories.php','Something Went Wrong');
 }
?>