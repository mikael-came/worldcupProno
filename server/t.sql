SELECT matchs.id, grp.nom_groupe, matchs.date,equipe1.id as id_equipe1, equipe2.i as id_equipe2,
equipe1.nom_equipe as equipe1,equipe2.nom_equipe as equipe2
FROM  `matchs` 
LEFT JOIN  `groupe_matchs` AS grp ON grp.id = matchs.id_groupe_matchs
LEFT JOIN  `equipes` equipe1 ON matchs.id_equipe1 = equipe1.ID
LEFT JOIN  `equipes` equipe2 ON matchs.id_equipe2 = equipe2.ID