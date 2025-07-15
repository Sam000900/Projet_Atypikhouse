import axios from 'axios';

// Get all articles
export const getAllArticles = async () => {
  return await axios
    .get('/articles/getAll')
    .then(response => { return response.data })
    .catch((error) => console.log(error));
}

// Get the last 6 articles
export const getLastSixArticles = async () => {
  return await axios
    .get('/articles/getLastSix')
    .then(response => { return response.data })
    .catch((error) => console.log(error));
}