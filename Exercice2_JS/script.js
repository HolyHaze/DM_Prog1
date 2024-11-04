// Fonction pour valider les frappes au clavier
function validateKey(event) {
    // Bloquer les caractères 'e' et 'E' pour empêcher la saisie de valeurs exponentielles
    if (event.key === 'e' || event.key === 'E') {
        event.preventDefault(); // Empêche l'événement de se produire
        return false; // Retourne faux pour indiquer que la touche est bloquée
    }
    return true; // Retourne vrai si la touche est valide
}

// Fonction pour effectuer les calculs
function calculate(operation) {
    // Récupération des valeurs saisies dans les champs de nombre
    const number1 = document.getElementById("number1").value; // Premier nombre
    const number2 = document.getElementById("number2").value; // Deuxième nombre
    const resultElement = document.getElementById("result"); // Élément pour afficher le résultat

    // Vérifier que les valeurs ne sont pas vides
    if (number1 === "" || number2 === "") {
        resultElement.value = "Erreur : Entrée invalide"; // Affiche un message d'erreur si l'une des valeurs est vide
        return; // Sort de la fonction si les valeurs sont invalides
    }

    // Convertir les valeurs saisies en nombres flottants
    const num1 = parseFloat(number1);
    const num2 = parseFloat(number2);
    let result; // Variable pour stocker le résultat du calcul

    // Calculer en fonction de l'opération choisie
    switch (operation) {
        case '+':
            result = num1 + num2; // Addition
            break;
        case '-':
            result = num1 - num2; // Soustraction
            break;
        case '*':
            result = num1 * num2; // Multiplication
            break;
        case '/':
            // Vérification pour éviter la division par zéro
            if (num2 === 0) {
                resultElement.value = "Erreur : Division par zéro"; // Affiche un message d'erreur si division par zéro
                return; // Sort de la fonction
            }
            result = num1 / num2; // Division
            break;
        default:
            result = "Opération non reconnue"; // Message d'erreur pour une opération non reconnue
    }

    // Afficher le résultat dans l'élément prévu
    resultElement.value = result;
}

// Fonction pour réinitialiser la calculatrice
function clearCalculator() {
    // Réinitialiser les champs de saisie à une chaîne vide
    document.getElementById("number1").value = ""; // Vide le champ du premier nombre
    document.getElementById("number2").value = ""; // Vide le champ du deuxième nombre
    document.getElementById("result").value = ""; // Vide le champ du résultat
}
