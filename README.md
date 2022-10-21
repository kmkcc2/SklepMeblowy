# Temat projektu: Sklep meblowy 
## Specyfikacja projektu
### Cel projektu : Stworzenie prostej strony internetowej służącej do zamawiania mebli biurowych
#### Cele szczegółowe:
   1. stworzenie intuicyjnego interfejsu użytkownika
   2. stworzenie systemu logowania i rejestracji
   3. stworzenie systemu zarządzania produktami dla administratora
### Funkcjonalności:
### Funkcjonalności po stronie administratora:<br>
•	Modyfikowanie produktów <br>
•	Zarządzanie kontami użytkowników<br>
•	Dodawanie/usuwanie produktów<br>
•	Zmiana statusów zamówień<br>
•	Wstrzymanie dostępności danego produktu<br>
## Funkcjonalności po stronie użytkownika:<br>
•	Logowanie/rejestracja<br>
•	Koszyk zakupów<br>
•	Wyświetlanie listy zamówień<br>
•	System potwierdzania adresu email<br>
•	Sprawdzanie statusu zamówienia<br>
•	Wyszukiwanie i sortowanie produktów<br>
•	Personalizacja produktów<br>
•	Przywracanie hasła<br>
•	Modyfikowanie danych konta<br>
### Interfejs serwisu

   <details>
       <summary>Ekran główny </summary>
	
![Ekran glowny](https://github.com/UR-IiE/21-22-ai-projekt-krowicki_ciomcia_kubik/blob/main/screenshots/ekran_glowny.png)
           <p>Przedstawiono ekran powitalny aplikacji</p>
   </details>
	<details>
       <summary>Ekran logowania</summary>

![Ekran logowania](https://github.com/UR-IiE/21-22-ai-projekt-krowicki_ciomcia_kubik/blob/main/screenshots/ekran_logowania.png)
           <p>Przedstawiono panel logowania się do konta</p>
   </details>
   	<details>
       <summary>Ekran rejestracji </summary>
	
![Ekran rejestracji](https://github.com/UR-IiE/21-22-ai-projekt-krowicki_ciomcia_kubik/blob/main/screenshots/ekran_rejestracjio.png)
           <p>Przedstawiono panel rejestracji nowego użytkownika.</p>
   </details> 
   	<details>
       <summary>Ekran zarządzania </summary>
	
![Ekran zarzadzania](https://github.com/UR-IiE/21-22-ai-projekt-krowicki_ciomcia_kubik/blob/main/screenshots/ekran_zarzadzania_1.png)
           <p>Przedstawiono opcje zarządzania z poziomu administratora</p>
   </details>
   <details>
	    <summary>Ekran zarządzania produktami</summary>
	
![Ekran zarzadzania 2](https://github.com/UR-IiE/21-22-ai-projekt-krowicki_ciomcia_kubik/blob/main/screenshots/ekran_zarzadzania_2.png)
           <p>Przedstawiono przykładową opcje zarządzania produktami z poziomu administratora</p>
</details>
   <details>
       <summary>Koszyk zakupów z produktem</summary>
	
![Koszyk zakupów](https://github.com/UR-IiE/21-22-ai-projekt-krowicki_ciomcia_kubik/blob/main/screenshots/koszyk.png)
           <p>Przedstawiono widok koszyka w którm znajduję się przedmiot</p>

   </details>
   <details> 
	<summary>Koszyk zakupów bez produktu</summary>
	
![Koszyk zakupów 2](https://github.com/UR-IiE/21-22-ai-projekt-krowicki_ciomcia_kubik/blob/main/screenshots/koszyk_2.png)
           <p>Przedstawiono widok pustego koszyka.</p>
</details>

### Baza danych
####	Diagram ERD
![diagram ERD](https://github.com/UR-IiE/21-22-ai-projekt-krowicki_ciomcia_kubik/edit/main/ERD.png)
####	Skrypt do utworzenia struktury bazy danych
[database](https://github.com/UR-IiE/21-22-ai-projekt-krowicki_ciomcia_kubik/blob/main/sklepmeblowy.sql)
## Wykorzystane technologie
* HTML
* CSS
* Bootstrap 5
* JavaScript
* JQuery
* PHP
* MySQL
## Realizacja połączenia z bazą danych mysql
* baza danych jest zrealizowana w folderze controller w pliku connection.php
	* zmienna host przyjmuje ip hosta. W przypadku hosta lokalnego może to być localhost lub 127.0.0.1
	* zmienna user odnosi się do nazwy użytkownika.
	* zmienna db określa nazwę bazy danych
* mysql domyślnie jest uruchomiony na porcie 3306
## Proces uruchomienia aplikacji (krok po kroku)
1. instalacja środowiska xampp w celu uruchomienia lokalnego serwera www oraz phpmyadmin
2. uruchomienie serwera apache oraz mysql
3. utworzenie bazy danych oraz import pliku .sql
4. umieszczenie plików strony w folderze htdocs, w miejscu instalacji programu xampp
5. uruchomienie strony internetowej poprzez wpisanie w przeglądarce adresu localhost/projekt
### Potrzebne nazwy użytkowników do uruchomienia aplikacji
***
#### Konto użytkownika
##### email: test@email.com
##### haslo: Qwerty123
***
#### Konto administratora
##### email: admin@email.com
##### haslo: Qwerty123
***

