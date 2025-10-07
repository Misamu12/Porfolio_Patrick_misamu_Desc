document.addEventListener("DOMContentLoaded", () => {
  // Set current year in footer
  document.getElementById("current-year").textContent = new Date().getFullYear()

  // Theme toggle functionality
  const themeToggle = document.getElementById("theme-toggle")
  const body = document.body

  // Check for saved theme preference or use preferred color scheme
  const savedTheme = localStorage.getItem("theme")
  if (savedTheme === "dark" || (!savedTheme && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
    body.classList.add("dark-theme")
  }

  themeToggle.addEventListener("click", () => {
    body.classList.toggle("dark-theme")
    const theme = body.classList.contains("dark-theme") ? "dark" : "light"
    localStorage.setItem("theme", theme)

    // Animation de transition pour le changement de thème
    body.style.transition = "background-color 0.5s ease, color 0.5s ease"

    // Notification visuelle du changement de thème
    showThemeChangeNotification(theme)
  })

  // Fonction pour afficher une notification lors du changement de thème
  function showThemeChangeNotification(theme) {
    // Créer l'élément de notification s'il n'existe pas déjà
    let notification = document.getElementById("theme-notification")
    if (!notification) {
      notification = document.createElement("div")
      notification.id = "theme-notification"
      notification.className = "theme-notification"
      document.body.appendChild(notification)
    }

    // Définir le contenu et la classe en fonction du thème
    notification.textContent = theme === "dark" ? "Mode sombre activé" : "Mode clair activé"
    notification.className = `theme-notification ${theme}`

    // Afficher la notification
    notification.classList.add("show")

    // Masquer la notification après 2 secondes
    setTimeout(() => {
      notification.classList.remove("show")
    }, 2000)
  }

  // Mobile menu functionality
  const mobileMenuBtn = document.querySelector(".mobile-menu-btn")
  const mobileMenuClose = document.querySelector(".mobile-menu-close")
  const mobileMenu = document.querySelector(".mobile-menu")
  const mobileNavLinks = document.querySelectorAll(".mobile-nav-links a")

  mobileMenuBtn.addEventListener("click", () => {
    mobileMenu.classList.add("active")
    document.body.style.overflow = "hidden"
  })

  mobileMenuClose.addEventListener("click", () => {
    mobileMenu.classList.remove("active")
    document.body.style.overflow = ""
  })

  mobileNavLinks.forEach((link) => {
    link.addEventListener("click", () => {
      mobileMenu.classList.remove("active")
      document.body.style.overflow = ""
    })
  })

  // Skill bars animation
  const skillBars = document.querySelectorAll(".skill-progress")

  function animateSkillBars() {
    skillBars.forEach((bar) => {
      const progress = bar.getAttribute("data-progress")
      bar.style.width = progress + "%"
    })
  }

  // Intersection Observer for animations
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          if (entry.target.classList.contains("skills-container")) {
            animateSkillBars()
          } else {
            entry.target.classList.add("animate")
          }
        }
      })
    },
    { threshold: 0.1 },
  )

  // Observe elements for animation
  document.querySelectorAll(".skills-container, .about-card, .project-card, .contact-card").forEach((el) => {
    observer.observe(el)
  })

  // Form submission
  const contactForm = document.getElementById("contact-form")

  contactForm.addEventListener("submit", (e) => {
    e.preventDefault()

    // Get form values
    const name = document.getElementById("name").value
    const email = document.getElementById("email").value
    const subject = document.getElementById("subject").value
    const message = document.getElementById("message").value

    // Here you would typically send the form data to a server
    // For demonstration, we'll just log it to console
    console.log("Form submitted:", { name, email, subject, message })

    // Show success message (in a real application)
    alert("Merci pour votre message ! Je vous répondrai dans les plus brefs délais.")

    // Reset form
    contactForm.reset()
  })

  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault()

      const targetId = this.getAttribute("href")
      if (targetId === "#") return

      const targetElement = document.querySelector(targetId)
      if (targetElement) {
        const navbarHeight = document.querySelector(".navbar").offsetHeight
        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarHeight

        window.scrollTo({
          top: targetPosition,
          behavior: "smooth",
        })
      }
    })
  })
})
