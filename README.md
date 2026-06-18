# Staha - Professional Maritime Hub

Staha is a premium, all-in-one professional ecosystem designed for the global seafarer. It empowers maritime professionals to track their sea-time, discover live job opportunities, and build a verified professional presence.

## Features

- **Maritime Job Board**:
    - **Deep Search**: Real-time web scraping to find live, verified jobs from global maritime sources.
    - **Automated Updates**: Background scraping system to keep the job board fresh.
    - **Verified Listings**: Direct links to company postings with verified tags.

- **SeaTime Tracking**:
    - Digital logbook for tracking voyage days and rank progress.
    - Automatic alerts for license and certification renewals.

- **Newsletter System**:
    - Weekly "Latest Jobs" dispatches for subscribers.
    - Modern subscription UI integrated into the hub.

- **Professional Profile**:
    - Showcase maritime experience, certificates, and ranks.
    - Connect with recruiters and shipowners directly.

## Tech Stack

- **Backend**: PHP 8.x, MySQL
- **Frontend**: Vanilla CSS, Tailwind CSS (CDN), JavaScript (ES6+)
- **Icons**: Remix Icon, FontAwesome
- **Automation**: PHP-based scraping engine with DOM/XPath parsing

## Getting Started

1.  **Clone the repository**:
    ```bash
    git clone https://github.com/kurauka/Staha.git
    ```
2.  **Database Setup**:
    - Import `database/schema.sql` into your MySQL server.
    - Update `config/db.php` with your database credentials.
3.  **Automation**:
    - Setup a cron job for automated job scraping:
    ```bash
    * */6 * * * php /path/to/scripts/cron_update_jobs.php
    ```
    - Setup a weekly newsletter trigger:
    ```bash
    0 9 * * 1 php /path/to/scripts/send_newsletter.php
    ```

## Contributing

Designed and built for seafaring excellence. For major changes, please open an issue first to discuss what you would like to change.

## License

[MIT](https://choosealicense.com/licenses/mit/)
