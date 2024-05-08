import mysql.connector
import random as rdm

# ////////////////////////////////////////////////////////////////////////////////////////////
#     Update                                                             ///
# ////////////////////////////////////////////////////////////////////////////////////////////
connection = mysql.connector.connect(
    host="localhost", user="root", password="mdp", database="project"
)
cursor = connection.cursor()

for i in range(87):
    num = 1
    num += i
    location = rdm.choice(
        [
            "Bloc1",
            "Bloc2",
            "Bloc3",
            "Bloc4",
            "Bloc5",
            "Bloc6",
            "Bloc7",
            "Bloc8",
            "Bloc9",
        ]
    )

    cursor.execute(f"UPDATE products SET location = '{location}'WHERE id = '{num}' ")
    connection.commit()


cursor.close()
connection.close()
print("-----------------------------------------------------------------------")
