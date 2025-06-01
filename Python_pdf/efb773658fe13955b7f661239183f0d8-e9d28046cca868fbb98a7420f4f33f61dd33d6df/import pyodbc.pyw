import pyodbc

DATABASE_PATH = r"C:\Users\admin\Downloads\New folder\Assignment3CS415\Python_pdf\efb773658fe13955b7f661239183f0d8-e9d28046cca868fbb98a7420f4f33f61dd33d6df\Academic.accdb"

try:
    conn = pyodbc.connect(r"DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};DBQ=" + DATABASE_PATH)
    print("✅ Database connection successful!")
    conn.close()
except pyodbc.Error as e:
    print("❌ Error connecting to database:", e)

    