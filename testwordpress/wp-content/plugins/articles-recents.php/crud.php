<?php

function create($email,$id_question,$reponse){
    global $wpdb;
    $wpdb->insert('historique', array(
            'email' => $email,
            'id_question' => $id_question,
            'reponse' => $reponse,
    ));
}


function create_user_db($email, $name) {
    global $wpdb;
    $wpdb->insert('utilisateurs', array(
            'email' => $email,
            'roles' => "[]",
            'valide' => 0,
            'id_historique' => 0,
            'agent' => $_SERVER['HTTP_USER_AGENT']
    ));
}

function create_question_db($question) {
    global $wpdb;
    $wpdb->insert('question', array(
            'question' => $question
    ));
}


function read($page, $cat){
    global $wpdb;
    $limite=1;
    $limite = 1;
    $page-=1;
    $req2 =$wpdb->get_results( "SELECT question, name_quiz FROM question WHERE name_quiz = '{$cat}' LIMIT $limite OFFSET $page ");
    $resultat=($req2[0]->question);
    return $resultat;
}

function update($email){
    global $wpdb;
    $wpdb->update(
        'utilisateurs',
        array(
            'valide' => 1
        ),
        array(
            'email' => $email,
        )
    );
}

function update_quiz($email){
    global $wpdb;
    $date = date("Y-m-d H:i");
    $wpdb->update(
        'utilisateurs',
        array(
            'date_quiz' => $date,
        ),
        array(
            'email' => $email,
        )
    );
}


function is_valid($email){
    global $wpdb;
    $req2 =$wpdb->get_results( "SELECT valide FROM utilisateurs WHERE email='{$email}' ");
    $resultat=($req2[0]->valide);
    return $resultat; // soit 1 ou 0  si 1 alors impossible de repondre  si 0 alors oui repondre
}
