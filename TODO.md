# TODO: Implement Dark Theme and UI Improvements

## CSS Updates
- [x] Update `resources/css/app.css`:
  - Remove gradients from `.btn-primary`, make it solid dark color.
  - Increase roundness of `.input-field` to rounded-2xl.
  - Ensure `.card-glass` remains dark without gradients.

## Layout Updates
- [x] Update `resources/views/layouts/guest.blade.php`:
  - Remove gradients from atom backgrounds, make them solid dark colors.

## Auth Page Updates
- [x] Update `resources/views/auth/login.blade.php`:
  - Remove gradients from logo and button.
  - Wrap the form in a `.card-glass` div for form frame.
  - Improve spacing and hierarchy.

- [x] Update `resources/views/auth/select-role.blade.php`:
  - Remove gradients from logo and card backgrounds.
  - Make cards solid dark.

- [x] Update `resources/views/auth/register.blade.php`:
  - Remove gradients from logo and button.
  - Wrap the form in a `.card-glass` div for form frame.
  - Improve spacing and hierarchy.

## Testing
- [ ] Test the UI changes in browser.
- [ ] Ensure consistency across all auth pages.
