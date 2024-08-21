const config = require('../config');
const axios = require('axios');

/* Not working (WIP) */

const sendWhatsAppMessage = async (phone, templateName, languageCode = 'es_ES') => {
    const whatsappApiUrl = config.whatsApp.url;
    const token = config.whatsApp.keySecret;

    const data = {
        messaging_product: 'whatsapp',
        to: phone,
        type: 'template',
        template: {
            name: templateName,
            language: {
                code: languageCode
            }
        }
    };

    try {
        await axios.post(whatsappApiUrl, data, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            }
        });
        console.log(`Message sent to ${phone} using template ${templateName}`);
    } catch (error) {
        console.error('Error sending message via WhatsApp:', error.response ? error.response.data : error.message);
    }
};

module.exports = sendWhatsAppMessage;