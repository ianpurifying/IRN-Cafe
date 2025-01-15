<link href="modules/bootstrap/node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
/* General CSS */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Nunito', sans-serif;
}

body {
  background: linear-gradient(to bottom, #ffefba, #ffffff);
  color: #333;
}

.bigContainer {
  padding: 50px 20px;
  max-width: 1200px;
  margin: auto;
}

.heading {
  text-align: center;
  font-size: 2.5rem;
  font-weight: bold;
  margin-bottom: 20px;
}

.subHeading {
  text-align: center;
  font-size: 1.2rem;
  margin-bottom: 40px;
  color: #666;
}

.team-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
}

.team-card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  text-align: center;
  width: 300px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  position: relative;
}

.team-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.team-card img {
  width: 100%;
  height: 300px;
  object-fit: cover;
  cursor: pointer;
}

.team-card h3 {
  font-size: 1.5rem;
  margin: 15px 0;
  color: #333;
}

.team-card p {
  font-size: 1rem;
  color: #666;
  margin: 0 15px 15px;
}

.team-card .social-icons {
  position: absolute;
  bottom: 10px;
  left: 10px;
  display: flex;
  gap: 10px;
}

  .social-icons a {
    color: #333;
  font-size: 1.5rem;
}

.explore {
  display: block;
  width: fit-content;
  margin: 40px auto 0;
  padding: 15px 40px;
  background-color: #f49892;
  color: #fff;
  font-size: 1rem;
  font-weight: bold;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  box-shadow: 0 4px 8px rgba(244, 152, 146, 0.3);
  transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.explore:hover {
  background-color: #f4aeb1;
  box-shadow: 0 6px 12px rgba(244, 152, 146, 0.4);
}

/* Modal styles */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

.close {
  position: absolute;
  top: 20px;
  right: 25px;
  color: #fff;
  font-size: 40px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: #f4aeb1;
}

/* Responsive CSS */
@media (max-width: 768px) {
  .team-card img {
    height: 250px;
  }

  .team-card h3 {
    font-size: 1.2rem;
  }

  .team-card p {
    font-size: 0.9rem;
  }

  .explore {
    font-size: 0.9rem;
  }
}
</style>
<div class="bigContainer">
  <h1 class="heading">About Us</h1>
  <p class="subHeading">Hi! We're a group of 3rd-year Computer Science students from <a href="https://cdscdb.edu.ph/" target="_blank">Colegio de Santo Cristo de Burgos</a>, and we are excited to share our little business with you. We built this website from scratch, and we're proud of it!</p>
  
  <div class="team-container">
    <!-- Person 1 -->
    <div class="team-card">
      <img src="assets/img/ian_img.jpg" alt="Ian's Image" onclick="openModal('ianModal')">
      <h3>Ian Purificacion</h3>
      <p>He is our coder and UI designer. He ensures everything looks good and works smoothly.</p>
      <div class="social-icons">
        <a href="https://www.facebook.com/ianpurifying/" target="_blank"><i class="bi bi-facebook"></i></a>
      </div>
    </div>
    
    <!-- Person 2 -->
    <div class="team-card">
      <img src="assets/img/rica_img.jpg" alt="Rica's Image" onclick="openModal('ricaModal')">
      <h3>Rica May Dando</h3>
      <p>She is our PowerPoint expert. She's great at creating slides that capture everyone's attention.</p>
      <div class="social-icons">
        <a href="https://www.facebook.com/ricamay.dando.94" target="_blank"><i class="bi bi-facebook"></i></a>
      </div>
    </div>
    
    <!-- Person 3 -->
    <div class="team-card">
      <img src="assets/img/nicole_img.png" alt="Nicole's Image" onclick="openModal('nicoleModal')">
      <h3>Nicole Villapando</h3>
      <p>She is our documentation specialist, ensuring every detail is recorded and presented with clarity.</p>
      <div class="social-icons">
        <a href="https://www.facebook.com/nicvillapando26" target="_blank"><i class="bi bi-facebook"></i></a>
      </div>
    </div>
  </div>
  
  <button class="explore" onclick="location.href='index.php?page=contact'">Explore our Services</button>
</div>

<!-- Modal for Ian -->
<div id="ianModal" class="modal">
  <span class="close" onclick="closeModal('ianModal')">&times;</span>
  <img class="modal-content" src="assets/img/ian_img.jpg" alt="Ian's Image">
</div>

<!-- Modal for Rica -->
<div id="ricaModal" class="modal">
  <span class="close" onclick="closeModal('ricaModal')">&times;</span>
  <img class="modal-content" src="assets/img/rica_img.jpg" alt="Rica's Image">
</div>

<!-- Modal for Nicole -->
<div id="nicoleModal" class="modal">
  <span class="close" onclick="closeModal('nicoleModal')">&times;</span>
  <img class="modal-content" src="assets/img/nicole_img.png" alt="Nicole's Image">
</div>

<script>
  function openModal(modalId) {
    document.getElementById(modalId).style.display = "block";
  }

  function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
  }
</script>
