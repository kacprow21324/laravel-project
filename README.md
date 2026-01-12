# System Zarządzania Kliniką Weterynaryjną - VetCare

Kompleksowa aplikacja internetowa stworzona w oparciu o framework Laravel, służąca do obsługi procesów biznesowych i medycznych w klinice weterynaryjnej. System oferuje dedykowane panele dla Administratorów, Personelu Medycznego oraz Klientów, zapewniając pełną obsługę wizyt, dokumentacji medycznej oraz magazynu leków.

Projekt kładzie szczególny nacisk na **dostępność cyfrową (WCAG 2.1 AA)**, poprawność semantyczną HTML5 oraz niezawodność potwierdzoną testami automatycznymi.

## Kluczowe Funkcjonalności

### 1. Dostępność i UX (Premium Accessibility)
Projekt wyznacza nowe standardy w dostępności aplikacji webowych:
* **Lektor (Text-to-Speech):** Zintegrowany syntezator mowy (Web Speech API), który czyta treść strony, wspierając osoby niewidome i słabowidzące.
* **Zgodność z WCAG 2.1 AA:** Pełna obsługa nawigacji klawiaturą, poprawne atrybuty ARIA i semantyczny kod HTML (zwalidowany w W3C Validator).
* **Tryb Wysokiego Kontrastu:** Dedykowany styl czarno-żółty/cyjan dla maksymalnej czytelności.
* **Skalowanie Tekstu:** Widget pozwalający na dynamiczną zmianę wielkości czcionki (A-, A, A+).
* **Visual Feedback:** Wyraźne komunikaty błędów w formularzach (czerwone ramki, teksty pomocnicze) informujące użytkownika o niepoprawnych danych.

### 2. Panel Klienta
Interfejs dla właścicieli zwierząt z zaawansowaną walidacją biznesową:
* **Rejestracja i Profil:** Zakładanie konta i zarządzanie danymi.
* **Zarządzanie pupilami:** Dodawanie zwierząt (blokada ujemnej wagi, blokada dat urodzenia z przyszłości).
* **Inteligentny System Rezerwacji:**
    * Umawianie wizyt w godzinach pracy kliniki (**Codziennie 08:00 - 20:00**).
    * Blokada umawiania wizyt wstecznych.
    * Możliwość umówienia wizyty "na dziś" (tylko na nadchodzące godziny).
* **Historia i Cennik:** Wgląd w historię leczenia i dynamiczny cennik usług.

### 3. Panel Lekarza i Magazyn
Narzędzia wspierające pracę medyczną:
* **Karty Pacjenta:** Diagnozy, zalecenia i historia chorób.
* **Zarządzanie Lekami:** Możliwość dodawania nowych leków do systemu oraz przepisywania ich pacjentom (z automatyczną kontrolą stanów magazynowych).
* **Dashboard:** Szybki podgląd nadchodzących wizyt.

### 4. Panel Administratora
Pełna kontrola nad systemem:
* **Zarządzanie Użytkownikami:** Możliwość usuwania kont lekarzy, administratorów i klientów.
* **Magazyn Centralny:** Dodawanie, edycja i kontrola asortymentu medycznego.
* **Raporty:** Przegląd aktywności w klinice.

---

## Technologie

Projekt został zrealizowany przy użyciu nowoczesnego stosu technologicznego:

* **Backend:** PHP 8.2+, Laravel 10/11
* **Baza Danych:** SQLite (Lekka, bezserwerowa baza w pliku - idealna do przenoszenia projektu)
* **Frontend:** Blade Templates, Tailwind CSS (Medical Modern UI)
* **Testy:** PHPUnit (Feature Tests z bazą in-memory)

---

## Instalacja i Konfiguracja

Aby uruchomić projekt w środowisku lokalnym, wykonaj następujące kroki:

1.  **Sklonuj repozytorium:**
    ```bash
    git clone [https://github.com/kacprow21324/laravel-project](https://github.com/kacprow21324/laravel-project)
    cd zad9_12_projekt_Woszczyło_21324
    ```

2.  **Zainstaluj zależności PHP:**
    ```bash
    composer install
    ```

3.  **Skonfiguruj środowisko:**
    Skopiuj plik `.env.example` na `.env` i skonfiguruj połączenie z bazą danych.
    ```bash
    cp .env.example .env
    ```

4.  **Wygeneruj klucz aplikacji:**
    ```bash
    php artisan key:generate
    ```

5.  **Utwórz link symboliczny do zdjęć:**
    Wymagane do poprawnego wyświetlania zdjęć zwierząt i tła.
    ```bash
    php artisan storage:link
    ```

6.  **Uruchom migracje i seedery:**
    Polecenie to utworzy strukturę bazy danych i wypełni ją danymi testowymi (konta, usługi, leki).
    ```bash
    php artisan migrate:fresh --seed
    ```

7.  **Uruchom serwer:**
    ```bash
    php artisan serve
    ```

---

## Testy Automatyczne

Projekt posiada zestaw testów jednostkowych/funkcjonalnych (Feature Tests) sprawdzających kluczową logikę biznesową (godziny pracy, walidację danych). Testy wykonywane są w pamięci RAM (in-memory), więc nie resetują głównej bazy danych.

**Uruchomienie testów:**
```bash
php artisan test
```
---

## Konta Testowe

Po wykonaniu seedowania bazy danych (`migrate:fresh --seed`), dostępne są następujące konta z domyślnym hasłem:

**Hasło dla wszystkich kont:** `haslo123`

| Rola | Email | Uprawnienia |
| :--- | :--- | :--- |
| **Administrator** | `admin@klinika.pl` | Pełny dostęp do systemu, zarządzanie użytkownikami i magazynem. |
| **Weterynarz** | `lekarz@klinika.pl` | Obsługa wizyt, wgląd w karty pacjentów, przepisywanie leków. |
| **Klient** | `klient@klinika.pl` | Rezerwacja wizyt, dodawanie zwierząt, podgląd historii. |

---

## Autor

**Kacper Woszczyło**
Nr indeksu: 21324
Projekt zaliczeniowy: Aplikacje Internetowe
