# 📋 Complete Room Fields Location Guide

## Where to Find & Update Room Information

This guide shows you **EXACTLY** where each field is located in the Vendor/Super Admin room forms.

---

## 🔗 Access URLs

### Vendor Panel:
- **Create Room:** `/vendor-admin/room-create/{hotelId}`
- **Edit Room:** `/vendor-admin/room/{roomId}/edit`

### Super Admin Panel:
- **Create Room:** `/super-admin/room-create/{hotelId}`
- **Edit Room:** `/super-admin/room/{roomId}/edit`

---

## 📑 Form Structure

The room form has **3 TABS**:

```
┌──────────────────────────────────────────────────────────┐
│  [ Room Details ]  [ Room Facilities ]  [ Room Photos ]  │
└──────────────────────────────────────────────────────────┘
```

---

## 🔵 TAB 1: "Room Details"

### This tab contains fields that populate "Room Information" (LEFT COLUMN) in modal

---

### 🏠 **Basic Information Section**

| Field Label | Input Type | Example Value | Shows in Modal As |
|-------------|------------|---------------|-------------------|
| **Room Name** | Text input | "Twin Room" | Header: "Twin Room" |
| **Room Number** | Text input | "105" | "Room # 105" |
| **Room Floor Number** | Number input | "3" | "3rd Floor" |

---

### 💰 **Price Section** (Purple heading: "Price Section")

| Field Label | Input Type | Example Value | Shows in Modal As |
|-------------|------------|---------------|-------------------|
| **Room Price (Per Night)** | Number input | "5000" | "BDT 5000.00 Per Night" |
| **Weekend Price** | Number input | "6000" | Used for weekend pricing |
| **Holiday Price** | Number input | "7000" | Used for holiday pricing |

---

### 💵 **Discount Section**

| Field Label | Input Type | Example Value | Shows in Modal As |
|-------------|------------|---------------|-------------------|
| **Discount Type** | Radio buttons | • Amount<br>• Percentage | Calculates discount |
| **Discount Value** | Number input | "69" (%) or "3000" (amount) | "69% off" badge |

**How it appears after discount selection:**
- Shows discount field dynamically when you select a discount type
- Enter value (e.g., 69 for 69% off)

---

### 📊 **Room Specifications Section**

These fields have **+/- counter buttons**:

| Field Label | Counter (+/-) | Example | Shows in Modal As |
|-------------|---------------|---------|-------------------|
| **Total Person in this room!** | [-] 2 [+] | 2 | ✅ "Capacity: 2 Adults Maximum" |
| **Room Size (sq. ft / sq. m)** | Text input | 10 | ✅ "Room Size: 10 sq ft" |
| **Total Room** | [-] 3 [+] | 3 | ✅ "Available Rooms: 3" |
| **Total Washroom** | [-] 1 [+] | 1 | ✅ "Washrooms: 1" |
| **Total Beds** | [-] 1 [+] | 1 | ✅ "Beds: 1" |
| **WiFi Details/Password** | Text input | "5555" | ✅ "WiFi: 5555" |

---

### 📝 **Description Section**

| Field Label | Input Type | Example | Shows in Modal As |
|-------------|------------|---------|-------------------|
| **Room Description** | Large textarea | "Lorem ipsum..." | Description paragraph at top of modal |

**Location:** At the bottom of "Room Details" tab, full-width textarea

---

## 🟢 TAB 2: "Room Facilities"

### This tab has 4 SECTIONS that populate the modal

---

### ⚡ **SECTION 1: Appliances Information**

**Location:** Top of "Room Facilities" tab
**Purple heading:** "Appliances Information"
**Has:** "Select All" checkbox

**Checkboxes available:**
- [ ] AC
- [ ] TV
- [ ] Fridge
- [ ] Microwave
- [ ] Fan
- [ ] Lamp
- [ ] Light
- [ ] Water heater/Geyser
- [ ] WiFi Router
- [ ] Crockeries
- [ ] Gas Stove
- [ ] Electric Kettle
- [ ] Room Heater
- [ ] Hair Dryer

**Plus:** 
- 🔵 **"Add More" button** - Adds custom appliances (like "Coffee Maker")

**Shows in Modal:** ✅ **"Room Information" (Left Column)**

---

### 🛋️ **SECTION 2: Furniture Information**

**Location:** Middle of "Room Facilities" tab
**Purple heading:** "Furniture Information"
**Has:** "Select All" checkbox

**Checkboxes available:**
- [ ] Bed ✅
- [ ] Dining Table with Chair ✅
- [ ] Sofa/Couch ✅
- [ ] Tea Table ✅
- [ ] Bedside Table ✅
- [ ] Shoe Rack ✅
- [ ] Clothing Cabinet ✅
- [ ] Clothes Drying Hanger ✅
- [ ] Iron Stand ✅
- [ ] Locker/Safe ✅

**Plus:**
- 🟢 **"Add More" button** - Adds custom furniture (like "123" in your example)

**Shows in Modal:** ✅ **"Additional Room Information" (Right Column)**

---

### 🧴 **SECTION 3: Room Amenities**

**Location:** Below Furniture section
**Purple heading:** "Room Amenities"

**Checkboxes available:**
- [ ] Soap
- [ ] Tissue
- [ ] Shampoo
- [ ] Toothbrush ✅
- [ ] Towel ✅
- [ ] Water bottle ✅
- [ ] Free laundry
- [ ] Air freshener
- [ ] Fruit basket
- [ ] Complimentary drinks
- [ ] Buffet breakfast

**Plus:**
- 🟢 **"Add More" button** - Adds custom amenities

**Shows in Modal:** ✅ **"Additional Room Information" (Right Column)**

---

### 📜 **SECTION 4: Cancellation Policy**

**Location:** Bottom of "Room Facilities" tab
**Purple heading:** "Cancellation Policy"

**Fields:**
- Text inputs for policy rules
- 🟢 **"Add Rule" button** - Adds more policy lines

**Example entries:**
1. "flexible" ✅
2. "non_refundable" ✅

**Shows in Modal:** ✅ **"Additional Room Information" (Right Column)** as "Policy: flexible", "Policy: non_refundable"

---

## 🎯 MAPPING: Form → Modal Display

### Modal "Room Details" Tab Structure:

```
╔═══════════════════════════════════════════════════════════╗
║  Description Paragraph (from Room Description field)     ║
╠═══════════════════════════╦═══════════════════════════════╣
║ 🛏️ Room Information       ║ 🛏️ Additional Room           ║
║                           ║    Information                ║
╠═══════════════════════════╬═══════════════════════════════╣
║ FROM:                     ║ FROM:                         ║
║ • Room Size field         ║ • Furniture checkboxes        ║
║ • Total Person counter    ║ • Room Amenities checkboxes   ║
║ • Total Beds counter      ║ • Cancellation Policy fields  ║
║ • Total Washrooms counter ║ • Custom furniture (Add More) ║
║ • Total Room counter      ║ • Custom amenities (Add More) ║
║ • WiFi Details field      ║                               ║
║ • Appliances checkboxes   ║                               ║
║ • Custom appliances       ║                               ║
╚═══════════════════════════╩═══════════════════════════════╝
```

---

## 📸 **Visual Form Layout**

### TAB 1: Room Details

```
┌─────────────────────────────────────────────────────┐
│ 🔵 Room Details Tab                                 │
├─────────────────────────────────────────────────────┤
│                                                     │
│ Room Name:           [Twin Room           ]         │
│ Room Number:         [105                 ]         │
│ Room Floor Number:   [3                   ]         │
│                                                     │
│ ━━━━━━━ Price Section ━━━━━━━                      │
│ Room Price (Per Night): [5000            ]         │
│ Weekend Price:          [6000            ]         │
│ Holiday Price:          [7000            ]         │
│                                                     │
│ Discount Type:                                      │
│ ( ) Discount by Amount                              │
│ (•) Discount by Percentage (%)                      │
│     Enter Discount Percentage: [69        ]         │
│                                                     │
│ Total Person: [-] 2 [+]    ◄── Shows: "Capacity: 2"│
│ Room Size: [10           ] ◄── Shows: "Room Size: 10"│
│ Total Room: [-] 3 [+]      ◄── Shows: "Available: 3"│
│ Total Washroom: [-] 1 [+]  ◄── Shows: "Washrooms: 1"│
│ Total Beds: [-] 1 [+]      ◄── Shows: "Beds: 1"    │
│ WiFi Details: [5555      ] ◄── Shows: "WiFi: 5555" │
│                                                     │
│ Room Description:                                   │
│ ┌─────────────────────────────────────────────┐   │
│ │ Lorem ipsum dolor sit amet...               │   │
│ │ (This shows at top of modal)                │   │
│ └─────────────────────────────────────────────┘   │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### TAB 2: Room Facilities

```
┌─────────────────────────────────────────────────────┐
│ 🟢 Room Facilities Tab                              │
├─────────────────────────────────────────────────────┤
│                                                     │
│ ━━━ Appliances Information ━━━                     │
│ [ ] Select All                                      │
│ [✓] AC          ◄─┐                                │
│ [✓] TV            │ Shows in "Room Information"    │
│ [✓] Fridge        │ (Left Column)                  │
│ [ ] Microwave   ◄─┘                                │
│ [ ] Fan                                             │
│ ... (more checkboxes)                               │
│ [Add More] ◄── Add custom appliances                │
│                                                     │
│ ━━━ Furniture Information ━━━                      │
│ [ ] Select All                                      │
│ [✓] Bed                ◄─┐                         │
│ [✓] Dining Table         │ Shows in "Additional    │
│ [✓] Sofa/Couch           │ Room Information"       │
│ [✓] Tea Table            │ (Right Column)          │
│ [✓] Bedside Table        │                         │
│ [✓] Shoe Rack          ◄─┘                         │
│ ... (more checkboxes)                               │
│ [Add More] ◄── Add "123" or custom furniture        │
│                                                     │
│ ━━━ Room Amenities ━━━                             │
│ [✓] Soap                                            │
│ [✓] Toothbrush    ◄─┐                              │
│ [✓] Towel           │ Shows in "Additional         │
│ [✓] Water bottle  ◄─┘ Room Information"            │
│ ... (more checkboxes)                               │
│ [Add More] ◄── Add custom amenities                 │
│                                                     │
│ ━━━ Cancellation Policy ━━━                        │
│ Policy 1: [flexible          ] [Delete]            │
│ Policy 2: [non_refundable    ] [Delete]            │
│ [Add More] ◄── Add more policy rules                │
│                                                     │
└─────────────────────────────────────────────────────┘
```

---

## 🎯 **Quick Reference: Your Current Data**

Based on your screenshot showing:

### ✅ Room Information (Left):
```
✓ Room Size: 10 sq ft       ← Room Size field: [10]
✓ Capacity: 2 Adults        ← Total Person: [-] 2 [+]
✓ Maximum Beds: 1           ← Total Beds: [-] 1 [+]
✓ Washrooms: 1              ← Total Washroom: [-] 1 [+]
✓ Available Rooms: 3        ← Total Room: [-] 3 [+]
✓ WiFi: 5555               ← WiFi Details: [5555]
```

### ✅ Additional Room Information (Right):
```
✓ Bed                       ← [✓] Bed (Furniture checkbox)
✓ Dining Table with Chair   ← [✓] Dining Table (Furniture)
✓ Sofa/Couch               ← [✓] Sofa/Couch (Furniture)
✓ Tea Table                ← [✓] Tea Table (Furniture)
✓ Bedside Table            ← [✓] Bedside Table (Furniture)
✓ Shoe Rack                ← [✓] Shoe Rack (Furniture)
✓ Clothing Cabinet         ← [✓] Clothing Cabinet (Furniture)
✓ 123                      ← Custom furniture "Add More" button
✓ Toothbrush               ← [✓] Toothbrush (Amenity)
✓ Towel                    ← [✓] Towel (Amenity)
✓ Water bottle             ← [✓] Water bottle (Amenity)
✓ Policy: flexible         ← Cancellation Policy field 1
✓ Policy: non_refundable   ← Cancellation Policy field 2
```

---

## 🔍 **How to Update Each Section:**

### **To Update "Room Information" (Left Column):**

1. Go to room edit page
2. Click **"Room Details"** tab (first tab)
3. Scroll down to find these fields:
   - `Room Size (sq. ft / sq. m)` - Text input
   - `Total Person in this room!` - Counter with +/- buttons
   - `Total Beds` - Counter with +/- buttons
   - `Total Washroom` - Counter with +/- buttons
   - `Total Room` - Counter with +/- buttons
   - `WiFi Details/Password` - Text input
4. Scroll down more to **"Room Facilities"** tab
5. Check boxes in **"Appliances Information"** section
6. Click **Submit**

### **To Update "Additional Room Information" (Right Column):**

1. Go to room edit page
2. Click **"Room Facilities"** tab (second tab)
3. Scroll to **"Furniture Information"** section
   - Check furniture boxes you have
   - Click **"Add More"** to add custom items like "123"
4. Scroll to **"Room Amenities"** section
   - Check amenity boxes you provide
   - Click **"Add More"** to add custom amenities
5. Scroll to **"Cancellation Policy"** section
   - Enter policy text (e.g., "flexible")
   - Click **"Add More"** to add another policy
6. Click **Submit**

---

## 💡 **Pro Tips:**

### **Counter Buttons (+/-):**
```
[-]  2  [+]
 ↓   ↓   ↓
Minus Current Plus
      Value
```
- Click **[+]** to increase
- Click **[-]** to decrease
- The number updates automatically

### **"Add More" Buttons:**
When you click "Add More", a new text input field appears:
```
[Custom item text here        ] [Delete]
```
- Type your custom item
- Click "Add More" again for another field
- Click "Delete" to remove a field

### **Select All Checkbox:**
- Quickly check/uncheck all items in a section
- Located at the top of Appliances and Furniture sections

---

## 📱 **Full Field List by Location:**

### 📍 Room Details Tab → Room Information (Left):
1. ✅ Room Size (sq. ft)
2. ✅ Total Persons (capacity)
3. ✅ Total Beds
4. ✅ Total Washrooms
5. ✅ Total Rooms (available)
6. ✅ WiFi Details
7. ✅ + All checked Appliances (AC, TV, etc.)

### 📍 Room Facilities Tab → Additional Room Information (Right):
1. ✅ All checked Furniture items
2. ✅ All checked Amenities items
3. ✅ All Cancellation Policy entries
4. ✅ All custom items added via "Add More"

---

## 🎬 **Quick Action Steps:**

### To add "123" (like in your screenshot):
1. Go to edit room
2. Click "Room Facilities" tab
3. Scroll to "Furniture Information"
4. Click **"Add More"** button
5. Type **"123"** in the new field
6. Click Submit
7. ✅ Now appears in "Additional Room Information"

### To add "flexible" policy:
1. Go to edit room
2. Click "Room Facilities" tab
3. Scroll to "Cancellation Policy"
4. Click **"Add Rule"** or **"Add More"** button
5. Type **"flexible"**
6. Click Submit
7. ✅ Now appears as "Policy: flexible"

---

## 🎨 **Visual Field Map:**

```
VENDOR/SUPER ADMIN FORM               FRONTEND MODAL
═══════════════════════════════  →   ═══════════════════════════

TAB 1: Room Details
┌─────────────────────────┐          ┌──────────────────────────┐
│ Room Size: [10]         │────────► │ ✓ Room Size: 10 sq ft    │
│ Total Person: [-] 2 [+] │────────► │ ✓ Capacity: 2 Adults     │
│ Total Beds: [-] 1 [+]   │────────► │ ✓ Beds: 1                │
│ Total Washroom: [-] 1[+]│────────► │ ✓ Washrooms: 1           │
│ Total Room: [-] 3 [+]   │────────► │ ✓ Available Rooms: 3     │
│ WiFi Details: [5555]    │────────► │ ✓ WiFi: 5555             │
└─────────────────────────┘          └──────────────────────────┘
                                     Room Information (Left)

TAB 2: Room Facilities
┌─────────────────────────┐          ┌──────────────────────────┐
│ [✓] Bed                 │────────► │ ✓ Bed                    │
│ [✓] Dining Table        │────────► │ ✓ Dining Table with Chair│
│ [✓] Sofa/Couch          │────────► │ ✓ Sofa/Couch             │
│ [Add More] → [123]      │────────► │ ✓ 123                    │
│                         │          │                          │
│ [✓] Toothbrush          │────────► │ ✓ Toothbrush             │
│ [✓] Towel               │────────► │ ✓ Towel                  │
│ [✓] Water bottle        │────────► │ ✓ Water bottle           │
│                         │          │                          │
│ Policy: [flexible]      │────────► │ ✓ Policy: flexible       │
│ Policy: [non_refundable]│────────► │ ✓ Policy: non_refundable │
└─────────────────────────┘          └──────────────────────────┘
                                     Additional Room Info (Right)
```

---

## ✅ **Summary:**

**All fields are ALREADY in your forms!** They are organized across 2 tabs:

| Want to Update | Go To | Section/Field |
|----------------|-------|---------------|
| Room specs (size, beds, WiFi) | Room Details Tab | Counter buttons & text inputs |
| Appliances (AC, TV, etc.) | Room Facilities Tab | Appliances Information checkboxes |
| Furniture (Bed, Table, etc.) | Room Facilities Tab | Furniture Information checkboxes |
| Amenities (Soap, Towel, etc.) | Room Facilities Tab | Room Amenities checkboxes |
| Policies | Room Facilities Tab | Cancellation Policy text inputs |
| Custom items ("123") | Room Facilities Tab | "Add More" buttons |

---

**Everything is dynamic and working!** Just fill in the fields and check the boxes you want. 🎉

