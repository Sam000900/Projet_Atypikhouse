import axios from 'axios';

// Get the last fifty contacts
export const getLastFiftyContacts = async (page = 1) => {
  try {
    const response = await axios.get(`/contacts/getLastFifty?page=${page}`);
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}

export const markContactAsRead = async (id) => {
  try {
    const response = await axios.patch(`/contacts/${id}/read`);
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}

export const markContactAsUnread = async (id) => {
  try {
    const response = await axios.patch(`/contacts/${id}/unread`);
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}