import axios from 'axios';

// Get all articles
export const getAllArticles = async () => {
  try {
    const response = await axios.get('/articles/getAll');
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}

// Get the last 6 articles
export const getLastSixArticles = async () => {
  try {
    const response = await axios.get('/articles/getLastSix');
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}

// Get the last hundred articles
export const getLastHundredArticles = async (page = 1) => {
  try {
    const response = await axios.get(`/articles/getLastHundred?page=${page}`);
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}