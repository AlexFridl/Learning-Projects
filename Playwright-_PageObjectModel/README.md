# Playwright E2E Testing – Login Page (Page Object Model Example)

This project demonstrates my practice of End-to-End (E2E) testing using Playwright and the Page Object Model (POM) pattern in JavaScript.
It focuses on automating and testing the login functionality of the demo website https://the-internet.herokuapp.com/login

The goal of this project is to learn how to structure Playwright tests using POM, separating test logic from page interactions for cleaner and more maintainable test code.

## Technologies Used

**Playwright** – for browser automation and testing
**JavaScript (ES6)** – programming language
**Node.js** – runtime environment
**npm** – package manager

## Description of folders:
- pages/ → contains Page Object files (in this case, the login.js file representing the login page)

- tests/ → contains Playwright test files

- tests/demo/login.spec.js → includes the actual login test that interacts with the page through the Page Object model

## Project Setup

- Clone the repository: 
git clone https://github.com/yourusername/playwright-login-pom.git
- Navigate to the project folder:
cd playwright-login-pom
- Install dependencies: npm install
- Run tests: npx playwright test
- View the test report: npx playwright show-report

## Test Scenario

The test covers the following login cases:
- Successful login with valid username and password
- Failed login with invalid credentials
- Validation of error messages and secure area access

The tests interact with:
🔗 https://the-internet.herokuapp.com/login

## Learning Objectives

Through this project, I practiced:

- Writing and organizing E2E tests in Playwright
- Implementing the Page Object Model (POM) structure
- Locating elements using Playwright selectors
- Performing assertions for login success and error handling
- Running tests in headless and headed (UI) modes
