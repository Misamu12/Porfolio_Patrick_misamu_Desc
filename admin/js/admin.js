document.addEventListener("DOMContentLoaded", () => {
  // Set current year in footer
  const currentYearElements = document.querySelectorAll("#current-year")
  currentYearElements.forEach((element) => {
    element.textContent = new Date().getFullYear()
  })

  // Theme toggle
  const themeToggle = document.getElementById("themeToggle")
  if (themeToggle) {
    // Check for saved theme preference
    const savedTheme = localStorage.getItem("adminTheme")
    if (savedTheme === "dark" || (!savedTheme && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
      document.body.classList.add("dark-theme")
    } else {
      document.body.classList.add("light-theme")
    }

    themeToggle.addEventListener("click", () => {
      document.body.classList.toggle("dark-theme")
      document.body.classList.toggle("light-theme")

      const theme = document.body.classList.contains("dark-theme") ? "dark" : "light"
      localStorage.setItem("adminTheme", theme)

      // Show theme change notification
      showThemeNotification(theme)
    })
  }

  // Function to show theme change notification
  function showThemeNotification(theme) {
    let notification = document.getElementById("themeNotification")
    if (!notification) {
      notification = document.createElement("div")
      notification.id = "themeNotification"
      notification.className = "theme-notification"
      document.body.appendChild(notification)
    }

    notification.textContent = theme === "dark" ? "Mode sombre activé" : "Mode clair activé"
    notification.classList.add("show")

    setTimeout(() => {
      notification.classList.remove("show")
    }, 2000)
  }

  // Sidebar toggle
  const sidebarToggle = document.getElementById("sidebarToggle")
  const menuToggle = document.getElementById("menuToggle")
  const sidebar = document.querySelector(".sidebar")

  if (sidebarToggle) {
    sidebarToggle.addEventListener("click", () => {
      sidebar.classList.toggle("collapsed")
      localStorage.setItem("sidebarState", sidebar.classList.contains("collapsed") ? "collapsed" : "expanded")
    })
  }

  if (menuToggle) {
    menuToggle.addEventListener("click", () => {
      sidebar.classList.toggle("show")
    })
  }

  // Check saved sidebar state
  const savedSidebarState = localStorage.getItem("sidebarState")
  if (savedSidebarState === "collapsed") {
    sidebar.classList.add("collapsed")
  }

  // Close sidebar on click outside on mobile
  document.addEventListener("click", (event) => {
    if (
      window.innerWidth < 992 &&
      sidebar.classList.contains("show") &&
      !sidebar.contains(event.target) &&
      event.target !== menuToggle
    ) {
      sidebar.classList.remove("show")
    }
  })

  // Modal functionality
  const modalTriggers = document.querySelectorAll('[data-toggle="modal"]')
  const modalClosers = document.querySelectorAll('[data-dismiss="modal"]')

  modalTriggers.forEach((trigger) => {
    trigger.addEventListener("click", function () {
      const targetModal = document.getElementById(this.getAttribute("data-target").substring(1))
      if (targetModal) {
        targetModal.classList.add("show")

        // Fill edit form if data attributes are present
        if (this.hasAttribute("data-skill-id")) {
          document.getElementById("edit_skill_id").value = this.getAttribute("data-skill-id")
          document.getElementById("edit_skill_name").value = this.getAttribute("data-skill-name")
          document.getElementById("edit_skill_level").value = this.getAttribute("data-skill-level")
          document.getElementById("edit_skill_level_output").value = this.getAttribute("data-skill-level")
          document.getElementById("edit_skill_logo_preview").src = "../" + this.getAttribute("data-skill-logo")
        }

        if (this.hasAttribute("data-project-id")) {
          // Fill project edit form
          const projectId = this.getAttribute("data-project-id")
          // In a real application, you would fetch the project data from the server
          // For this example, we'll use dummy data
          const projects = [
            {
              id: 1,
              title: "Pharma Prunelle",
              description:
                "Direction du projet qui a permis de placer des logiciels pour faciliter la gestion pharmaceutique.",
              date: "2023-01-15",
              tags: "Node.js, React.js, SQL",
              image: "https://via.placeholder.com/500x300",
            },
            {
              id: 2,
              title: "Portfolio Startup",
              description:
                "Directeur du développement de l'architecture de l'Application web (portfolio) de la Startup.",
              date: "2022-11-20",
              tags: "React.js, Tailwind CSS, JavaScript",
              image: "https://via.placeholder.com/500x300",
            },
          ]

          const project = projects.find((p) => p.id == projectId)
          if (project) {
            document.getElementById("edit_project_id").value = project.id
            document.getElementById("edit_project_title").value = project.title
            document.getElementById("edit_project_description").value = project.description
            document.getElementById("edit_project_date").value = project.date
            document.getElementById("edit_project_tags").value = project.tags
            document.getElementById("edit_project_image_preview").src = project.image
          }
        }
      }
    })
  })

  modalClosers.forEach((closer) => {
    closer.addEventListener("click", function () {
      const modal = this.closest(".modal")
      if (modal) {
        modal.classList.remove("show")
      }
    })
  })

  // Close modal when clicking outside
  document.addEventListener("click", (event) => {
    if (event.target.classList.contains("modal")) {
      event.target.classList.remove("show")
    }
  })

  // File input preview
  const fileInputs = document.querySelectorAll('input[type="file"]')
  fileInputs.forEach((input) => {
    input.addEventListener("change", function () {
      const label = this.nextElementSibling
      if (this.files.length > 0) {
        label.querySelector("span").textContent = this.files[0].name
      } else {
        label.querySelector("span").textContent = "Choisir un fichier"
      }
    })
  })

  // Search functionality
  const searchInputs = document.querySelectorAll('[id$="Search"]')
  searchInputs.forEach((input) => {
    input.addEventListener("keyup", function () {
      const searchTerm = this.value.toLowerCase()
      const table = this.closest(".card").querySelector("table")
      if (table) {
        const rows = table.querySelectorAll("tbody tr")
        rows.forEach((row) => {
          const text = row.textContent.toLowerCase()
          row.style.display = text.includes(searchTerm) ? "" : "none"
        })
      }
    })
  })

  // Delete confirmation
  const deleteButtons = document.querySelectorAll('[data-action="delete"]')
  deleteButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      if (!confirm("Êtes-vous sûr de vouloir supprimer cet élément ?")) {
        e.preventDefault()
      }
    })
  })
})
