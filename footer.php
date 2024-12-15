<footer>
  <div class="footer-container">
    <p>&copy; 2024 Our Library. All rights reserved.</p>
    <ul class="footer-links">
      <li><a href="#">Privacy Policy</a></li>
      <li><a href="#">Terms & Conditions</a></li>
      <li><a href="#">Contact </a></li>
    </ul>
  </div>
</footer>

<style>
/* Footer Styles */
footer {
  background-color: #333;
  color: white;
  padding: 20px;
  text-align: center;
}

.footer-links {
  list-style-type: none;
  padding: 0;
  margin: 10px 0;
}

.footer-links li {
  display: inline;
  margin: 0 15px;
}

.footer-links a {
  color: white;
  text-decoration: none;
}

.footer-links a:hover {
  text-decoration: underline;
}

.footer-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 15px; /* Add some padding for smaller screens */
}

footer p {
  margin: 10px 0;
  font-size: 16px;
}

/* Responsive Design */

/* Tablet and mobile screens */
@media (max-width: 768px) {
  footer {
    padding: 15px;
  }

  .footer-links {
    text-align: center;
    margin-top: 15px;
  }

  .footer-links li {
    display: block;
    margin: 5px 0;
  }

  .footer-container {
    padding: 0 10px;
  }

  footer p {
    font-size: 14px;
  }
}

/* Mobile screens (extra small devices) */
@media (max-width: 480px) {
  footer {
    padding: 10px;
  }

  .footer-links li {
    margin: 5px 0;
  }

  footer p {
    font-size: 12px;
  }
}

</style>
