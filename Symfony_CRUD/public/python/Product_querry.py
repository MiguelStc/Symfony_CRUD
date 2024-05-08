import mysql.connector
import random as rdm

# ////////////////////////////////////////////////////////////////////////////////////////////
#     adding product script                                                             ///
# ////////////////////////////////////////////////////////////////////////////////////////////
connection = mysql.connector.connect(
    host="localhost", user="root", password="mdp", database="project"
)
cursor = connection.cursor()

products = "public/python/file.txt"

with open(products, "r", encoding="utf8") as file:
    lines = file.readlines()
    products_array = [line.strip() for line in lines]

for element in products_array:
    name = element
    supplier = rdm.choice(["Humeau", "Allsciences", "Avantor", "Fiser"])
    dangerIcon = "SGH09"
    amount = rdm.randint(4, 25)
    location = rdm.choice(
        [
            "Bloc8",
            "Bloc9",
            "Bloc8",
            "Bloc5",
            "Bloc8",
            "Bloc6",
        ]
    )
    locationType = "--"
    cursor.execute(
        f"INSERT INTO products(name,supplier,danger_icon,amount,location,location_type) VALUES('{name}','{supplier}','{dangerIcon}','{amount}','{location}','{locationType}')"
    )
    connection.commit()


cursor.close()
connection.close()
print("-----------------------------------------------------------------------")
