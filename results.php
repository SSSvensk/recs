<?php
$query = $_GET['query']; 
    // gets value sent over search form
     
    $min_length = 100;
    // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysql_query("SELECT * FROM courses
            WHERE (`id` LIKE '%".$query."%') OR (`unit` LIKE '%".$query."%')
            OR (`code` LIKE '%".$query."%') OR (`name` LIKE '%".$query."%')
            OR (`startDate` LIKE '%".$query."%') OR (`endDate` LIKE '%".$query."%')
            OR (`teachingLanguage` LIKE '%".$query."%') OR (`creditsMin` LIKE '%".$query."%')
            OR (`creditsMax` LIKE '%".$query."%') OR (`evaluationScale` LIKE '%".$query."%')
            OR (`enrollmentDescription` LIKE '%".$query."%') OR (`enrollmentUrl` LIKE '%".$query."%')
            OR (`subjectCode` LIKE '%".$query."%') OR (`degreeProgrammeCode` LIKE '%".$query."%')
            OR (`_opsi_opryhmät` LIKE '%".$query."%') OR (`studyPeriods0` LIKE '%".$query."%')
            OR (`studyPeriods1` LIKE '%".$query."%')") or die(mysql_error());
             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysql_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
             
                echo "<p>".$results['id']..$results['unit']..$results['code'].
                .$results['name']..$results['startDate']..$results['endDate'].
                .$results['teachingLanguage']..$results['creditsMin']..$results['creditsMax'].
                .$results['evaluationScale']..$results['enrollmentDescription'].
                .$results['enrollmentUrl']..$results['subjectCode']..$results['degreeProgrammeCode'].
                .$results['_opsi_opryhmät']..$results['studyPeriods0']..$results['studyPeriods1']."</p>";
                 // posts results gotten from database you can also show id ($results['id'])
            }
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
         
    }
    else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
    }
?>