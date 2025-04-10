document.addEventListener("DOMContentLoaded", () => {
  const links = document.querySelectorAll('.sidebar-menu .nav-link');

  // Siempre marcar el primero como activo (Inicio)
  links.forEach((link, index) => {
    if (index === 0) {
      link.classList.add('active');
    } else {
      link.classList.remove('active');
    }
  });

  links.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault(); // Evita que recargue

      // Quitar activo a todos y agregar al actual
      links.forEach(l => l.classList.remove('active'));
      this.classList.add('active');
    });
  });
});
