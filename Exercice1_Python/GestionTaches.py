import customtkinter as ctk  # Importer customtkinter pour créer une interface graphique moderne

# Configuration de la fenêtre principale
app = ctk.CTk()
app.geometry("500x500")  # Taille de la fenêtre
app.title("Gestion de tâches")

# Couleurs personnalisées pour le thème
ctk.set_appearance_mode("dark")  # Thème sombre pour un look moderne
ctk.set_default_color_theme("blue")  # Thème de couleur pour les widgets

# Liste pour stocker les tâches
tasks = []

# Fonction pour ajouter une tâche
def add_task():
    task_name = entry_task.get()
    if task_name:
        tasks.append(task_name)
        entry_task.delete(0, ctk.END)
        update_task_list()

# Fonction pour afficher les tâches dans l'interface
def update_task_list():
    task_list.configure(state="normal")  # Permettre les modifications
    task_list.delete("1.0", ctk.END)  # Vider le contenu actuel de task_list
    for idx, task in enumerate(tasks, 1):
        task_list.insert(ctk.END, f"{idx}: {task}\n")  # Insérer chaque tâche avec son numéro dans task_list
    task_list.configure(state="disabled")  # Désactiver l'édition de task_list

# Fonction pour supprimer une tâche
def delete_task():
    try:
        selected_index = int(entry_delete.get()) - 1  # Récupérer le numéro de la tâche à supprimer
        if 0 <= selected_index < len(tasks):  # Vérifier que le numéro est valide
            tasks.pop(selected_index)  # Supprimer la tâche
            update_task_list()  # Mettre à jour l'affichage de la liste
            entry_delete.delete(0, ctk.END)  # Effacer le champ de saisie
    except ValueError:
        pass  # Ignorer si la saisie n'est pas un nombre valide

# Création des widgets
label_title = ctk.CTkLabel(app, text="Gestion de Tâches", font=("Arial", 20, "bold"), text_color="lightblue")  # Titre stylisé
label_title.pack(pady=10)

entry_task = ctk.CTkEntry(app, placeholder_text="Entrez une nouvelle tâche", width=300, height=30, 
                          fg_color="lightgray", text_color="black")  # Champ de saisie stylisé
entry_task.pack(pady=5)

button_add = ctk.CTkButton(app, text="Ajouter Tâche", command=add_task, width=150, height=30, 
                           corner_radius=10, text_color="white")  # Bouton stylisé pour ajouter une tâche
button_add.pack(pady=5)

# Zone de texte stylisée pour afficher la liste des tâches
task_list = ctk.CTkTextbox(app, height=200, width=350, fg_color="gray25", text_color="white", font=("Arial", 12))
task_list.pack(pady=10)
task_list.configure(state="disabled")  # Désactiver l'édition directe dans la zone de texte

entry_delete = ctk.CTkEntry(app, placeholder_text="Numéro de la tâche à supprimer", width=300, height=30, 
                            fg_color="lightgray", text_color="black")  # Champ de saisie pour suppression
entry_delete.pack(pady=5)

button_delete = ctk.CTkButton(app, text="Supprimer Tâche", command=delete_task, width=150, height=30, 
                              corner_radius=10, text_color="white")  # Bouton stylisé pour supprimer une tâche
button_delete.pack(pady=5)

button_quit = ctk.CTkButton(app, text="Quitter", command=app.quit, width=100, height=30, 
                            corner_radius=10, fg_color="red", text_color="white")  # Bouton de sortie en rouge pour distinction
button_quit.pack(pady=10)

# Lancer l'application
app.mainloop()
