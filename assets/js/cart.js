document.addEventListener('click', async (e)=>{
  const row = e.target.closest('.cart-row'); if(!row) return;
  const id = row.dataset.id;
  const input = row.querySelector('input[type=number]');
  if(e.target.classList.contains('inc')) input.value = +input.value + 1;
  if(e.target.classList.contains('dec')) input.value = Math.max(1, +input.value - 1);
  if(e.target.classList.contains('remove')){
    await fetch('/primer_shop/api/cart.php', {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'},
      body: new URLSearchParams({action:'remove', product_id:id})});
    location.reload(); return;
  }
  if(e.target.classList.contains('inc') || e.target.classList.contains('dec')){
    await fetch('/primer_shop/api/cart.php', {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'},
      body: new URLSearchParams({action:'set', product_id:id, qty: input.value})});
    location.reload();
  }
});
