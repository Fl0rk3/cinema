# Watch Together — Cinema Reservation System

A cinema web application built with **PHP, MySQL, and JavaScript**, centered on a multi-step ticket reservation experience. Visitors can browse movies, select a screening, choose ticket categories and seats, and submit their reservation. An administration panel supports movie and screening management.

The interface content is primarily in Polish. This README describes the project in English.

## Project Overview

The project connects a database-backed movie catalogue with an interactive reservation interface. PHP renders movie information and screening schedules, while JavaScript manages the reservation steps, selected seats, customer details, and price summary. The final reservation is submitted asynchronously to a PHP endpoint and stored in MySQL.

The implemented flow is for **seat reservations with payment at the cinema**. The online purchase option is displayed but disabled; payment processing is not implemented.

## Multi-Step Reservation Flow

Before entering the reservation form, the visitor selects a movie from the catalogue or opens the full screening calendar. The calendar can display all screenings or only those for a selected movie. Choosing a screening passes its schedule ID to the reservation page.

The reservation page contains six panels organized under four progress headings: **Terms → Ticket Selection → Order → Confirmation**.

| Step | Visitor action | Implementation |
| --- | --- | --- |
| 1. Terms | Select the reservation option and accept the terms. | JavaScript checks the acceptance checkbox before advancing. |
| 2. Ticket categories | Choose quantities of standard, student, reduced-price, and senior tickets. | The browser checks that the combined quantity is between 1 and 10 tickets. |
| 3. Seat selection | Pick seats from an interactive auditorium map. | JavaScript generates the map, marks existing reservations, tracks selected seats, and requires the seat count to match the ticket count. |
| 4. Customer details | Enter first name, surname, email, and phone number. | Browser-side checks require names, a basic email format, and a nine-character phone number. |
| 5. Summary | Review customer details, screening information, ticket quantities, and prices. | JavaScript calculates subtotals and the total, then submits customer data, seat coordinates, and the screening ID through AJAX. |
| 6. Confirmation | View the completion screen and return to the catalogue. | The interface displays confirmation when the reservation endpoint returns its success response. |

Back buttons allow visitors to revisit earlier parts of the form before submission. The active panel and progress heading are controlled through CSS classes, so the intermediate steps take place on the same page.

## Interactive Seat Map

The auditorium is generated in JavaScript with **15 rows and 20 seats per row**, separated by a central aisle: **300 seats in total**.

- **Green** indicates an available seat.
- **Gray** indicates a seat already reserved for the selected screening.
- **Orange** indicates a seat selected in the current reservation.

PHP retrieves existing seat reservations for the screening and exposes them to JavaScript as JSON. Clicking an available seat adds its row and seat number to the selection; clicking a selected seat removes it. A counter shows how many seats remain to be chosen and warns when too many are selected.

The next step is available only when the number of selected seats matches the requested ticket quantity. Existing reservations are loaded when the page opens; the map does not use live polling or temporary seat holds.

## Code Organization and Data Flow

The application uses procedural PHP and browser JavaScript, with separate folders for page templates, request handlers, database access, styles, and assets.

1. **Server-rendered pages** — `index.php` and the pages in `sites/` combine HTML with movie and screening data retrieved through PHP helper functions.
2. **Shared database queries** — `php/functions.php` contains helpers for the catalogue, movie details, schedule rendering, screening information, and reserved-seat lookup. Schedule queries join movies with their screening dates and times.
3. **Reservation state** — `scripts/reserv.js` stores ticket quantities, selected seat coordinates, customer details, and the screening ID in browser variables. Functions switch panels, validate intermediate input, and update the summary.
4. **Asynchronous submission** — jQuery sends JSON-encoded values in a POST request to `php/reserv.php`, without reloading the page for the submission itself.
5. **Database persistence** — the reservation handler looks up a customer with matching details or creates a customer record, then inserts a ticket record for each chosen seat linked to that customer and screening.

Ticket categories and prices are used in the browser-side summary. The reservation request sends customer details, seats, and the screening ID; it does not persist ticket categories or calculated prices.

## Administration Panel

The project also includes an administrative workflow with a login page and PHP session state.

- Add movies with a title, poster upload, genre, and production information.
- Assign movies to screening dates and predefined time slots.
- Check whether a date and time slot is already occupied before adding a screening.
- View the screening list with movie titles, dates, and times.
- Delete screenings from the schedule.
- Switch between administration sections with JavaScript and log out through a PHP handler.

## Tech Stack

| Technology | Role |
| --- | --- |
| PHP | Page rendering, reservation handling, administration actions, and session state |
| MySQL | Movie, screening, customer, ticket, and administrator records |
| PDO | Database access from PHP |
| HTML / CSS | Page structure, reservation panels, seat states, and Flexbox layouts |
| JavaScript | Step navigation, dynamic seat generation, selection tracking, validation, and price calculations |
| jQuery | AJAX submission of reservation data |
| Anime.js | Animated text on the catalogue and calendar pages |

## Project Structure

```text
cinema-main/
|-- index.php           # Movie catalogue
|-- sites/
|   |-- calendar.php    # Full schedule or screenings for one movie
|   |-- hall.php        # Reservation panels and initial seat data
|   |-- login.php       # Administrator login page
|   `-- admin.php       # Movie and screening management
|-- php/                # Shared queries and reservation/admin handlers
|-- database/           # PDO connection and database configuration
|-- scripts/            # Reservation logic, admin navigation, and animation
|-- css/                # Shared and page-specific styles
|-- gfx/                # Movie posters and interface images
`-- README.md
```

## What This Project Demonstrates

- Designing a multi-step form with progress indicators, validation, and backward navigation.
- Generating an interactive seat map from database records and browser-side selection state.
- Connecting server-rendered PHP pages with JavaScript interactions and AJAX requests.
- Modeling relationships between movies, screenings, customers, and reserved seats.
- Building an administrative interface for managing the content used by the public reservation flow.
