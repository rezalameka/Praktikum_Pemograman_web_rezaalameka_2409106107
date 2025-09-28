// script.js

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("order-form");
  const bookingResult = document.getElementById("booking-result");
  const kodeBooking = document.getElementById("kode-booking");
  const totalHarga = document.getElementById("total-harga");
  const darkToggle = document.getElementById("dark-toggle");

  // Harga tiap menu
  const menuHarga = {
    rendang: 35000,
    "ayam-pop": 28000,
    "gulai-ikan": 32000,
    dendeng: 30000,
  };

  // Form submit handler
  form.addEventListener("submit", (e) => {
    e.preventDefault();

    let total = 0;
    let menuDipilih = [];

    Object.keys(menuHarga).forEach((menu) => {
      const checkbox = document.getElementById(menu);
      const qtyInput = document.getElementById(`qty-${menu}`);
      if (checkbox.checked && qtyInput.value > 0) {
        const jumlah = parseInt(qtyInput.value);
        total += menuHarga[menu] * jumlah;
        menuDipilih.push(`${checkbox.labels[0].innerText} x${jumlah}`);
      }
    });

    if (total === 0) {
      alert("Silakan pilih menu dan jumlah pesanan terlebih dahulu!");
      return;
    }

    const kode = "SBPD-" + Math.floor(Math.random() * 9000 + 1000);

    kodeBooking.textContent = kode;
    totalHarga.textContent = total.toLocaleString("id-ID");
    bookingResult.style.display = "block";

    form.reset();
    console.log("Pesanan:", menuDipilih.join(", "));
  });

  // Dark Mode toggle
  darkToggle.addEventListener("click", () => {
    document.body.classList.toggle("dark-mode");

    if (document.body.classList.contains("dark-mode")) {
      darkToggle.textContent = "☀️ Light Mode";
      localStorage.setItem("theme", "dark");
    } else {
      darkToggle.textContent = "🌙 Dark Mode";
      localStorage.setItem("theme", "light");
    }
  });

  // Cek preferensi theme dari localStorage
  if (localStorage.getItem("theme") === "dark") {
    document.body.classList.add("dark-mode");
    darkToggle.textContent = "☀️ Light Mode";
  }
});
