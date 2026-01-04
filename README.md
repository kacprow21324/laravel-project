# System Zarządzania Kliniką Weterynaryjną - VetCare

Kompleksowa aplikacja internetowa stworzona w oparciu o framework Laravel, służąca do obsługi procesów biznesowych i medycznych w klinice weterynaryjnej. System oferuje dedykowane panele dla Administratorów, Personelu Medycznego oraz Klientów, zapewniając pełną obsługę wizyt, dokumentacji medycznej oraz magazynu leków.

Projekt kładzie szczególny nacisk na dostępność cyfrową (WCAG 2.1 AA) oraz nowoczesny interfejs użytkownika (Medical Modern UI).

## Kluczowe Funkcjonalności

### 1. Dostępność i UX (WCAG & Design)
Projekt został zaprojektowany z myślą o inkluzywności i nowoczesnych standardach webowych:
* **Zgodność z WCAG 2.1 AA:** Pełna obsługa nawigacji klawiaturą, poprawne atrybuty ARIA oraz semantyczny HTML.
* **Tryb Wysokiego Kontrastu:** Dedykowany styl nadpisujący kolory witryny na schemat czarno-żółty/cyjan, zapewniający maksymalną czytelność.
* **Skalowanie Tekstu:** Widget pozwalający na dynamiczną zmianę wielkości czcionki (A-, A, A+) z zapisem preferencji użytkownika.
* **Medical Modern UI:** Estetyczny, przejrzysty interfejs oparty na kartach, cieniach i gradientach, zbudowany przy użyciu Tailwind CSS.

### 2. Panel Klienta (Frontend)
Interfejs przeznaczony dla właścicieli zwierząt:
* **Samodzielna rejestracja:** Możliwość założenia konta z automatycznym przypisaniem roli Klienta.
* **Zarządzanie pupilami:** Dodawanie zwierząt do systemu wraz ze zdjęciem profilowym (upload plików).
* **System rezerwacji:** Umawianie wizyt poprzez wybór lekarza, usługi i terminu.
* **Historia leczenia:** Wgląd w historię odbytych wizyt, diagnozy oraz przepisane leki.
* **Dynamiczny Cennik:** Podstrona Oferta pobierająca aktualne ceny zabiegów bezpośrednio z bazy danych.

### 3. Panel Lekarza (Backend Operacyjny)
Narzędzia wspierające codzienną pracę weterynarza:
* **Dashboard:** Szybki podgląd nadchodzących wizyt i statystyk.
* **Obsługa wizyty:** Wypełnianie karty pacjenta, diagnozy i zaleceń.
* **Przepisywanie leków:** Moduł zintegrowany z magazynem – system weryfikuje stan magazynowy w czasie rzeczywistym i blokuje przepisanie ilości większej niż dostępna.
* **Podgląd historii:** Dostęp do pełnej dokumentacji medycznej pacjenta.

### 4. Panel Administratora
Pełna kontrola nad systemem:
* **Zarządzanie personelem:** Rejestracja nowych lekarzy i pracowników.
* **Magazyn Leków:** Kontrola stanów magazynowych, dodawanie nowych partii leków.
* **Raporty i Statystyki:** Przegląd wszystkich wizyt w klinice.

---

## Technologie

Projekt został zrealizowany przy użyciu następujących technologii:

* **Backend:** PHP 8.2+, Laravel 10/11
* **Frontend:** Blade Templates

---

## Instalacja i Konfiguracja

Aby uruchomić projekt w środowisku lokalnym, wykonaj następujące kroki:

1.  **Sklonuj repozytorium:**
    ```bash
    git clone [https://github.com/twoj-nick/vetcare-project.git](https://github.com/twoj-nick/vetcare-project.git)
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