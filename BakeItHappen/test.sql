
delete from Ingredient;
delete from Recipe;
delete from Recipe_Ingredient; 

insert into Ingredient (in_name)
values  ("rice");
insert into Ingredient (in_name)
values  ("broccoli");
insert into Ingredient (in_name)
values  ("chicken");
insert into Ingredient (in_name)
values  ("teriyaki");

insert into Recipe (rec_name, rec_instruct)
values  ("chicken teriyaki", "Cook 1lb rice in instant pot, steam broccoli, lightly coat and fry chicken in teriyaki sauce, combine and serve");

--queries for recipes that contain ALL 4 of the ingredients listed. 
SELECT rec_name, rec_instruct 
FROM Recipe AS r 
INNER JOIN recipe_ingredient i ON i.rec_id = r.rec_id 
INNER JOIN Ingredient x ON x.in_id = i.in_id 
WHERE x.in_name IN ("chicken", "rice", "broccoli", "teriyaki") 
GROUP BY r.rec_name 
HAVING COUNT(*) = 4

--Inserts into Recipe with Name and Instructions
INSERT INTO Recipe (rec_name, rec_instruct) 
VALUES('Peanut Butter and Jelly', 'Spread Peanut Butter on one slice of bread, Spread Jelly on the other slice, Put slices together, Cut sandwich diagonally, Serve with milk');

--Inserts an Ingredient into the Ingredient table only if it does not exist already.
INSERT INTO Ingredient(in_name) (SELECT 'rice' FROM dual WHERE NOT EXISTS (SELECT in_name FROM Ingredient WHERE in_name='rice'));

INSERT INTO recipe_ingredient(in_id, rec_id) 
VALUES((SELECT rec_id FROM recipe r WHERE r.rec_name = 'chicken teriyaki'), (SELECT in_id FROM ingredient i WHERE i.in_name = 'rice'))