<?php
$example_persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ]
];
/*
print_r($example_persons_array);
echo '<br>';
echo '<br>';
var_dump($example_persons_array);
echo '<br>';
echo '<br>';
*/

function getFullnameFromParts($surname, $name,  $patronomyc) {
    return $surname. " " . $name . " " . $patronomyc;
};

//getFullnameFromParts("ivanov", "ivan", "ivanovich");


function getPartsFromFullname($fio) {
    
    list($surname, $name, $patronomyc) = explode(' ',$fio);
    //echo $name;
    $array = array();
    $array['surname'] = $surname;
    $array['name'] = $name;
    $array['patronomyc'] = $patronomyc;
    
    return $array;
    
}
//print_r(getPartsFromFullname($example_persons_array[4]['fullname']));
//echo '<br>';

function getShortName($fio2) {
    $reductSurname = getPartsFromFullname($fio2)['surname'];
    $reductName= getPartsFromFullname($fio2)['name'];
    echo $reductName . ' ' . mb_substr($reductSurname, 0, 1) . '.';
    //echo mb_substr($reductSurname, 0, 1);
};
/*
getShortName($example_persons_array[4]['fullname']);
echo '<br>';
*/
function getGenderFromName($fio3) {
    $reductSurname = getPartsFromFullname($fio3)['surname'];
    $reductName= getPartsFromFullname($fio3)['name'];
    $reductPatronomyc= getPartsFromFullname($fio3)['patronomyc'];
    $genderSign = 0;
    if ((mb_substr($reductPatronomyc, -3) == "вна") || (mb_substr($reductName, -1)=="а") || (mb_substr($reductSurname, -2)=="ва")) {
    $genderSign --;
       
    
    } else if ((mb_substr($reductPatronomyc, -2) == "ич") || (mb_substr($reductName, -1)=="й") || ((mb_substr($reductName, -1)=="н")) || (mb_substr($reductSurname, -1)=="в"))  {
    $genderSign ++;
    
    
    } 
    return $genderSign <=> 0;    
    
    /*
    echo mb_substr($reductPatronomyc, -3);
    echo mb_substr($reductName, -1);
    echo mb_substr($reductSurname, -2);
    */
};
/*print_r(getGenderFromName($example_persons_array[0]['fullname']));
echo '<br>';
echo '<br>';*/
function getGenderDescription ($arrayEx) {
    
    $male = 0;
    $female = 0;
    $neitr = 0;
    $all = count($arrayEx);

    foreach ($arrayEx as $value) {
        
        if (getGenderFromName($value['fullname'])>0) {
            $male++;
        } else if (getGenderFromName($value['fullname'])<0)
        {
            $female++;
        } else
            $neitr++;
               
   }
   $allMale = round($male * 100 / $all, 1);
   $allFemale = round($female * 100 / $all, 1);
   $allNeitr  = round($neitr * 100 / $all, 1);    
    
    echo 'Гендерный состав аудитории'. '<br>';
    echo '----------------------------------'. '<br>';
    echo 'Мужчины - '. $allMale . '%' .'<br>';
    echo 'Женщины - '. $allFemale . '%' .'<br>';
    echo 'Не удалось определить - '. $allNeitr . '%' .'<br>';
};
getGenderDescription($example_persons_array);
function getPerfectPartner($surname, $name, $patronomyc, $ex_array) {
    $surname = mb_convert_case($surname, MB_CASE_TITLE); 
    $name = mb_convert_case($name, MB_CASE_TITLE); 
    $patronomyc = mb_convert_case($patronomyc, MB_CASE_TITLE);
    $all = count($ex_array)-1;
    //echo getGenderFromName(getFullnameFromParts($surname, $name, $patronomyc));
    $allRand = rand(0, $all);
    while (getGenderFromName($ex_array[$allRand]['fullname']) == getGenderFromName(getFullnameFromParts($surname, $name, $patronomyc))) {
        //echo "нет пары";
        //echo '<br>';
        $allRand = rand(0, $all);
    };
    $percent = 50+rand(0, 1000)/(1000/(100-50));
    echo getShortName($ex_array[$allRand]['fullname']);
    echo ' + '; 
    echo getShortName(getFullnameFromParts($surname, $name, $patronomyc));
    echo ' = '; 
    echo '<br>';
    echo "&hearts; Идеально на $percent% &hearts;	"; 
    echo '<br>';    
    
};


getPerfectPartner("алеАксандрова", "марИя", "сергееВНА", $example_persons_array)


?>