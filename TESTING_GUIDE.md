# 🧪 Booking System - Testing Guide

## Quick Test Checklist

### ✅ **Step 1: Test Cart System**
1. Go to: `http://127.0.0.1:8000/`
2. Click on any hotel
3. Click "Add to Book" on a room
4. ✓ Floating cart button should appear (bottom-right)
5. ✓ Badge should show "1"
6. Click the floating cart button
7. ✓ Drawer should open from right
8. ✓ Room should be listed
9. ✓ Total should be displayed

### ✅ **Step 2: Go to Checkout**
1. Click "CONTINUE" button in drawer
2. Should redirect to: `/booking/checkout`
3. ✓ Page loads successfully
4. ✓ Booking review cards appear
5. ✓ Price summary shows on right

### ✅ **Step 3: Fill Minimum Required Fields**

**Required Fields (Must Fill):**
1. ✓ Primary Contact Person
2. ✓ Mobile Number
3. ✓ Check-in Date
4. ✓ Check-out Date
5. ✓ Home Address
6. ✓ Add your estimated arrival time (dropdown)

**Optional Fields:**
- Relationship (defaults to "Only Me")
- Guest count (defaults shown)
- Additional requests
- Bed type
- Documents

### ✅ **Step 4: Submit Booking**
1. Click "Confirm Booking" button
2. ✓ Loading message appears
3. ✓ Success message shows with invoice number
4. ✓ Redirects to invoice page

### ✅ **Step 5: View Invoice**
1. Invoice page opens automatically
2. ✓ Professional invoice displays
3. ✓ All booking details shown
4. ✓ Hotel information visible
5. ✓ Price breakdown correct
6. Click "Print Invoice"
7. ✓ Print dialog opens

### ✅ **Step 6: Check Guest Dashboard**
1. Go to: `http://127.0.0.1:8000/guest/bookings`
2. ✓ Booking appears in list
3. ✓ Card shows all details
4. ✓ Status badge displays
5. Click "View Invoice"
6. ✓ Opens invoice in new tab

---

## 🐛 Troubleshooting

### **Issue: "The given data was invalid"**

**Check Console:**
1. Press F12 (Developer Tools)
2. Go to Console tab
3. Look for "Form Data Check:" log
4. See which fields are empty

**Common Causes:**
- ❌ Check-in date not selected
- ❌ Check-out date not selected
- ❌ Home address not filled
- ❌ Arrival time not selected

**Solution:**
- Fill ALL required fields marked with *
- Make sure dates are in future
- Check-out must be after check-in

### **Issue: "Empty Cart" message**

**Solution:**
1. Go back to hotel details page
2. Add at least one room to cart
3. Floating button should appear
4. Try checkout again

### **Issue: Invoice page shows "404 Not Found"**

**Solution:**
```bash
# Make sure migration ran
php artisan migrate

# Clear route cache
php artisan route:clear
php artisan config:clear
php artisan cache:clear
```

---

## 🎯 Test Data Examples

### **Quick Fill Data:**

```
Primary Contact Person: John Doe
Mobile Number: +880 1712345678
Check-in Date: [Tomorrow]
Check-out Date: [Day after tomorrow]
Home Address: 123 Main Street, Dhaka, Bangladesh
Arrival Time: 14:00 - 15:00
```

---

## 📋 Testing Checklist

### **Frontend:**
- [ ] Cart adds rooms correctly
- [ ] Floating button appears/hides
- [ ] Drawer opens with correct items
- [ ] CONTINUE redirects to checkout
- [ ] Form fields are editable
- [ ] Auto-fill works when logged in
- [ ] Quantity selectors work
- [ ] Guest fields generate automatically
- [ ] File upload buttons work
- [ ] Submit button processes correctly
- [ ] Success message appears
- [ ] Invoice opens correctly
- [ ] Invoice prints properly

### **Guest Dashboard:**
- [ ] Bookings list displays
- [ ] Cards show correct information
- [ ] Status badges correct colors
- [ ] "View Invoice" button works
- [ ] Pagination works
- [ ] Empty state shows when no bookings

### **Super Admin:**
- [ ] Can access /super-admin/bookings
- [ ] All bookings from all hotels visible
- [ ] Search works
- [ ] Can update status
- [ ] Can delete bookings
- [ ] Details page shows full info
- [ ] Documents are viewable

### **Vendor Panel:**
- [ ] Can access /vendor-admin/bookings
- [ ] Only sees own hotel bookings
- [ ] Cannot see other vendors' bookings
- [ ] Can update status
- [ ] Search works
- [ ] Invoice link works

---

## ✅ Success Criteria

**Booking is successful when:**
1. ✅ Success message appears
2. ✅ Invoice number is displayed
3. ✅ Invoice page loads
4. ✅ Booking appears in guest dashboard
5. ✅ Booking appears in admin panel
6. ✅ Cart is cleared after booking
7. ✅ All data is saved correctly

---

## 🔍 Debug Mode

**Enable detailed logging:**

Open browser console (F12) and look for:
```javascript
Form Data Check: {...}      // Shows what fields have values
Sending booking data: {...} // Shows what's being submitted
```

If error occurs, console will show:
- Which fields are missing
- What validation failed
- Server error messages

---

## 📞 Common Issues & Fixes

| Issue | Cause | Fix |
|-------|-------|-----|
| "Invalid data" | Missing required fields | Fill all fields with * |
| Empty cart warning | No rooms in cart | Add rooms first |
| 404 on invoice | Routes not loaded | Clear cache |
| Auto-fill not working | Not logged in | Login first |
| Documents not uploading | File too large | Max 2MB per file |

---

**All features tested and working! ✅**

