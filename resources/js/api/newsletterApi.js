import axios from 'axios';

// Get the last fifty newsletters
export const getLastFiftyNewsletters = async (page = 1) => {
  try {
    const response = await axios.get(`/newsletters/getLastFifty?page=${page}`);
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}