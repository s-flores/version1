CREATE TABLE Ingredient (
    inID    int,
    inName  varchar(255),
    PRIMARY KEY(inID)
);

CREATE TABLE Recipe (
    recID    int,
    recName  varchar(255),
    recInstruct varchar(255),
    PRIMARY KEY(recID)
);

CREATE TABLE Recipe_Ingredient (
    riID    int,    
    inID    int,
    recID   int,
    PRIMARY KEY(riID),
    FOREIGN KEY(inID) REFERENCES Ingredient(inID),
    FOREIGN KEY(recID) REFERENCES Recipe(recID)
);