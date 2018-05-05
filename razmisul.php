<?php
$training_categories = array();
$all_answers_from_the_category = array();

//VIEW
foreach ($training_categories as $category)
{
    foreach ($category->anwers as $anwer)
    {
        $anwer->input();
    }
}

$user_answers = array(
    'training_category' => $all_answers_from_the_category,
    //za vsqka kategoriq taka
);


//DISHES

$dish = array();

foreach ($training_categories as $category)
{
    //add multiple select box
    //i izberi ot vs $category->anwers koi sa pozvoleni
    //trqbva nekvi custom pravila sush taka naprvimer: zakuska/vecherq
    return 0;
}

//PRAVENE NA PROGRAMA
//vzimane na vs qstiq koito suvpadat s tiq na usera
//razpedelqne prez cqlata sedmica
