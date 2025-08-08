body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
}

header {
    background-color: #333;
    color: white;
    display: flex;
    justify-content: space-between;
    padding: 10px;
}

header .header-left h1 {
    margin: 0;
}

header .header-right a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
}

header input[type="text"] {
    padding: 5px;
    width: 200px;
    border: none;
}

main {
    padding: 20px;
    background-color: white;
}

.product-list {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
}

.product {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 15px;
    text-align: center;
}

.product img {
    max-width: 100%;
    height: auto;
}

.product a {
    text-decoration: none;
    color: #333;
    background-color: #4CAF50;
    padding: 10px;
    border-radius: 5px;
    margin-top: 10px;
}

footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    width: 100%;
    bottom: 0;
}
