const render = (items)=>{
  const c = document.getElementById('products'); c.innerHTML='';
  if(items.length===0){ c.innerHTML='<p>Ничего не найдено.</p>'; return; }
  c.innerHTML = items.map(p=>`
    <a class="card" href="/primer_shop/product.php?id=${p.id}">
      <img src="/primer_shop/assets/img/products/${p.image}" alt="${p.title}">
      <div class="card-body">
        <div class="card-title">${p.title}</div>
        <div class="muted">${p.brand} • ${p.volume_ml} мл</div>
        <div class="price">${new Intl.NumberFormat('ru-RU',{style:'currency',currency:'RUB'}).format(p.price)}</div>
      </div>
    </a>
  `).join('');
};
const load = async()=>{
  const q = document.getElementById('search').value.trim();
  const brand = document.getElementById('brand').value;
  const sort = document.getElementById('sort').value;
  const r = await fetch(`/primer_shop/api/products.php?q=${encodeURIComponent(q)}&brand=${encodeURIComponent(brand)}&sort=${encodeURIComponent(sort)}`);
  render(await r.json());
};
['search','brand','sort'].forEach(id=> document.getElementById(id).addEventListener('input', load));
window.addEventListener('DOMContentLoaded', load);
