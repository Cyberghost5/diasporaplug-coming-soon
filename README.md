# DiasporaPlug EU — "Coming Soon" & Waitlist Landing Page

An ultra-modern, fully animated, high-conversion **Coming Soon & Waitlist Landing Page** for **DiasporaPlug EU**—the subscription-based marketplace connecting the African & Caribbean diaspora community across Europe with vetted, culturally grounded artisan services.

---

## 📁 Project Structure (100% Functional — Zero Broken Links)
```
📁 diasporaplug-coming-soon/
├── 📄 index.html           # Main landing page with full animations, waitlist & interactive modals
├── 📄 privacy.html         # Dedicated GDPR-compliant Privacy Policy page
├── 📄 terms.html           # Dedicated Platform Terms of Service page
├── 📄 cookies.html         # Dedicated EU Cookie Policy & Interactive Preference Center
├── 📄 README.md            # Documentation & architecture breakdown
├── 🖼️ IMG_5011.JPG.jpeg    # Original logo reference
├── 📁 assets/
│   ├── 🖼️ logo.jpg         # Raster logo
│   └── 📐 logo.svg         # Clean scalable transparent vector emblem
├── 📁 api/
│   ├── ⚙️ waitlist.php     # Production backend: email validation, deduplication & position assignment
│   └── ⚙️ artisan-apply.php# Production backend: artisan provider applications & verification queuing
└── 📁 data/
    ├── 🔒 .htaccess        # Direct web access denied for security
    ├── 📊 waitlist.csv     # Live Excel/Sheets ready subscriber export
    ├── 💾 waitlist.json    # JSON waitlist database
    ├── 📊 artisans.csv     # Live artisan applicants CSV export
    └── 💾 artisans.json    # JSON artisan database
```

---

## 🎨 Visual Identity & Color Palette (Extracted From Official Logo)
- **Primary Brand Teal (`#0E6E85`)**: The signature Mediterranean & Afro-Atlantic oceanic petrol blue from the outer emblem.
- **Electric Cyan Accent (`#22D3EE` / `#179BB8`)**: High-contrast modern tech highlights for badges, pills, and active states.
- **Vibrant Sunset Terracotta Orange (`#F15A24`)**: The energetic growth arrow and inner ring from the logo, used for primary magnetic CTAs, highlights, and confetti.
- **Midnight Obsidian Base (`#04080C`)**: Deep, luxurious dark canvas allowing glassmorphism and ambient mesh blurs to shine.
- **Warm Gold / Amber (`#F59E0B`)**: Rating stars and VIP Founding Member privileges.

---

## 🚀 Key Features & Architectural Breakdown

### 1. Minimalist Floating Glass Navbar
- **Brand Identity**: Features the custom scalable SVG emblem and typography (`DIASPORA` in white, `PLUG` in orange, and `EU` in teal badge).
- **Pulsing Live Status Pill**: Radar ping indicator showing `"Launching Soon Across the EU • Q2 2026"`.
- **Live Counter**: Real-time ticker preview (`1,428+ joined`).
- **Quick CTA**: Magnetic `"Join Waitlist"` button that smoothly scrolls to and focuses the email capture field.

### 2. High-Impact Hero Section (Above the Fold)
- **Eyebrow Capsule**: `"The Diaspora Service Club • EU"` with sparkle icon and `"Exclusive"` pill.
- **Hero Typography**: Plus Jakarta Sans 800-weight headline `"Trusted Artisans. One Simple Subscription."` with an animated brand gradient text.
- **Subheadline**: Explains the exact value prop—eliminating guesswork and WhatsApp groups for cooks, barbers, tailors, drivers, carpenters, and logistics.
- **Glassmorphic Waitlist Capture Form**:
  - Email input with envelope icon and instant regex validation.
  - Interactive EU city selector (Paris, Berlin, Amsterdam, Brussels, London, Frankfurt, Dublin, etc.).
  - Magnetic CTA button with orange glow and dynamic hover shimmer sheen.
  - Value incentive note: `"✨ Get early access + 30% off your first 3 months. Zero spam, unsubscribe anytime."`
  - Stacked social proof avatars showing `3,420+ members` and `4.9/5` quality score.
- **Floating Live Glass UI Mockup Cards**:
  - **Verified Master Tailor** (Berlin) • Aso-Ebi & Kente • 4.9★ • Member rate: €35/hr.
  - **Private Chef** (Paris) • Authentic Jollof & Suya • 5.0★ • Top Booked in Paris • 0% Booking Fees.
  - **Express Logistics Van** (Amsterdam) • En Route to Brussels • 100% Insured.

### 3. Infinite Animated Service Marquee
- Double-track, continuous, 60fps horizontal marquee featuring:
  - 🍳 **Cooks & Catering** (Native Chefs & Event Suya)
  - 💈 **Master Barbers** (Crisp Fades & Afro Sculpting)
  - 🪡 **Bespoke Tailors** (Ankara, Kente & Modern Cuts)
  - 🚗 **Private Drivers** (Airport Chauffeurs & VIP)
  - 📦 **Express Logistics** (Inter-city Relocation & Cargo Vans)
  - 🔨 **Skilled Carpenters** (Custom Woodwork & Assembly)
  - 🔧 **Home Repairs** (Verified Handymen & Electric)

### 4. Asymmetric Bento Grid ("What We’re Building")
- Interactive mouse-tracking **Spotlight Glow** (Linear/Apple style) and subtle **3D perspective tilt** on hover:
  - **Card 1 (Large - All-in-One Subscription)**: One flat membership fee, 0% booking fees, priority weekend slots, and escrow protection.
  - **Card 2 (100% Vetted Artisans)**: Government ID checks, cultural craft assessments, and peer reviews.
  - **Card 3 (Built for the EU Diaspora)**: Multi-currency EUR pricing (SEPA, iDEAL, Cartes Bancaires, Apple Pay) across Paris, Berlin, Amsterdam, Brussels, and London.
  - **Card 4 (Wide - Book in Seconds)**: Real-time slot availability, in-app chat simulation, and calendar sync.

### 5. Interactive Artisan Directory Showcase
- Filter tabs by category (Cooks, Barbers, Tailors, Drivers, Logistics, Carpenters) showcasing vetted diaspora artisans with real bios, ratings, and member pricing.

### 6. Interactive Waitlist Modal & VIP Ticket Pass
- On valid email submission:
  - Triggers a **Web Audio API harmonized chord chime** (no external audio assets required).
  - Fires a **multi-color confetti burst** (`#0E6E85`, `#F15A24`, `#22D3EE`, `#FBBF24`).
  - Displays the **Founding Member VIP Ticket** with simulated position (`#412 in line`), email confirmation, and referral fast-track link (`Jump 25 spots ahead`).
  - 1-click **WhatsApp** and **X (Twitter)** social sharing buttons.
  - Persists signup data in `localStorage`.

### 7. Launch Countdown & Clean Footer
- Live ticker counting down to the beta launch (`48 Days, 14 Hours, 32 Mins, 18 Secs`).
- Provider modal: `"Apply as a Verified Artisan"`.
- Footer with brand identity, mission tagline, social icons, and copyright (`© 2026 DiasporaPlug. All rights reserved.`).

---

## 🛠 Tech Stack
- **HTML5 & CSS3**: Native semantic markup and GPU-accelerated styling.
- **Tailwind CSS 3.4 (via CDN)**: Custom extended color palette, glassmorphism utilities, and keyframe animations.
- **GSAP 3.12+ & ScrollTrigger**: Staggered hero load animation and scroll-based section reveals.
- **Lucide Icons**: Crisp, minimalist vector iconography.
- **Canvas-Confetti**: Particle celebration physics.
- **Web Audio API**: Browser-native harmonic celebration synthesizer.
- **Google Fonts**: Plus Jakarta Sans, Space Grotesk, and Inter.

---

## 🌐 How to Run & View

### Option 1: Direct Browser Launch
Simply double-click or open `index.html` in any modern web browser (Chrome, Safari, Edge, Firefox).

### Option 2: Via Laragon (Your Local Web Server)
Since the files are located in your Laragon root (`C:\laragon\www\diasporaplug-coming-soon`):
1. Ensure Laragon is started.
2. Open your browser and navigate to:
   - `http://localhost/diasporaplug-coming-soon` or
   - `http://diasporaplug-coming-soon.test` (if Laragon Auto Virtual Hosts are active).

### Option 3: Via Node.js Static Server
Run in PowerShell:
```bash
npx serve .
```
and open the displayed URL (e.g. `http://localhost:3000`).
