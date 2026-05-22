# PeerSync Frontend UI Pages

Complete frontend UI for the PeerSync peer tutoring platform built with Tailwind CSS.

## Pages Created

### Public Pages (Unauthenticated)

- **`index.php`** - Landing page with features, how it works, and call-to-action
- **`login.php`** - User login page with PeerSync branding
- **`register.php`** - User registration page (students & tutors)

### Student Pages

- **`student_dashboard.php`** - Student overview with stats, active requests, and recent sessions
- Features: request status tracking, session management, achievement badges

### Tutor Pages

- **`tutor_dashboard.php`** - Tutor overview with earnings, active sessions, and specialties
- **`tutor_browse_requests.php`** - Browse and filter tutoring requests by subject, level, urgency
- Features: filters, request cards with student info, accept/decline actions

### Tutoring Interface

- **`tutoring_session.php`** - Live tutoring session with video, chat, whiteboard, and controls
- Features: dual video feed, real-time chat, session timer, collaborative tools

### Admin Pages

- **`admin_dashboard.php`** - System statistics, user management, session monitoring
- Features: charts, user distribution, recent sessions table, quick actions

## Design System

### Color Palette

- **Primary**: #0D9488 (Teal) - Main brand color
- **Dark**: #0a7a73 (Dark Teal) - Hover states
- **Background**: #f5f3ef (Light Beige)
- **Surface**: #ffffff (White)
- **Text**: #1a1a1a (Dark)
- **Muted**: #9a8f82 (Gray)

### Typography

- **Display**: Fraunces (serif) - Headings
- **Body**: DM Sans (sans-serif) - Body text

### Components Used

- Responsive grids
- Cards and stat boxes
- Navigation sidebars
- Form controls
- Filter dropdowns
- Status badges
- Data tables
- Charts/progress bars
- CTAs and buttons

## Features Built

✅ Responsive design (mobile-first)
✅ Role-based dashboards (Student, Tutor, Admin)
✅ Real-time tutoring session interface
✅ Request browsing and filtering
✅ User profiles with avatars
✅ Status tracking and notifications
✅ Analytics and statistics
✅ Gamification elements (badges, leaderboard)
✅ Chat messaging interface

## Next Steps

1. **Connect Backend**:
   - Integrate with PHP controllers
   - Wire up database queries
   - Add authentication logic

2. **Add Functionality**:
   - Real WebRTC video/audio
   - Database-driven content
   - Form submissions
   - User authentication

3. **Enhance UX**:
   - Add loading states
   - Error handling
   - Confirmation modals
   - Toast notifications

## File Structure

```
public/
├── index.php                    # Landing page
├── login.php                    # Login
├── register.php                 # Registration
├── student_dashboard.php        # Student dashboard
├── tutor_dashboard.php          # Tutor dashboard
├── tutor_browse_requests.php    # Browse requests
├── tutoring_session.php         # Live session
└── admin_dashboard.php          # Admin dashboard
```

## How to Use

1. Start your PHP server:

   ```bash
   php -S localhost:8000 -t public
   ```

2. Visit `http://localhost:8000` to see the landing page

3. Navigate to pages:
   - Login: `/login.php`
   - Register: `/register.php`
   - Student Dashboard: `/student_dashboard.php`
   - Tutor Dashboard: `/tutor_dashboard.php`
   - Browse Requests: `/tutor_browse_requests.php`
   - Session: `/tutoring_session.php`
   - Admin: `/admin_dashboard.php`

## Styling

All pages use Tailwind CSS loaded from CDN. No additional CSS files needed.

To customize colors, edit the hex values in the style tags or update the Tailwind classes directly.

## Icons & SVGs

All icons are inline SVGs. No icon library dependencies.

## Future Enhancements

- [ ] Mobile hamburger menu
- [ ] Dark mode support
- [ ] Accessibility improvements
- [ ] Loading skeletons
- [ ] Toast notification system
- [ ] Modal dialogs
- [ ] Infinite scroll for requests
- [ ] Advanced filtering
- [ ] Profile customization page
- [ ] Review/rating interface
