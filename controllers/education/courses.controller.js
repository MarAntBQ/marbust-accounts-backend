const config = require('../../config');
const sendEmail = require('../../services/sendEmail.service');

const MarbustEducationCourseCategory = require('../../models/education/MarbustEducationCourseCategory.model');
const MarbustEducationCourse = require('../../models/education/MarbustEducationCourse.model');

exports.createNew = async (req, res) => {
    try {
        const { name, publishedDate, categoryId, enabled } = req.body;

        // Validate Category
        const category = await MarbustEducationCourseCategory.findByPk(categoryId);
        if (!category) {
            return res.status(400).json({ error: 'Invalid category ID' });
        }

        // Predeterminated values
        const finalPublishedDate = publishedDate || new Date();
        const finalEnabled = enabled !== undefined ? enabled : true

        // Crear el nuevo curso
        const newCourse = await MarbustEducationCourse.create({
            name,
            publishedDate: finalPublishedDate,
            categoryId,
            enabled: finalEnabled
        });

        res.status(201).json(newCourse);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Internal server error', serverReport: error});
    }
};