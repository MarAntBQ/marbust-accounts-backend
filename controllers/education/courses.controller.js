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

exports.getAllCategories = async (req, res) => {
    try {
        const categories = await MarbustEducationCourseCategory.findAll({
            attributes: ['id', 'name']
        });
        res.status(200).json(categories);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Internal server error', serverReport: error});
    }
};

exports.getCourseDetails = async (req, res) => {
    try {
        const { courseId } = req.params;
        const course = await MarbustEducationCourse.findByPk(courseId, {
            include: {
                model: MarbustEducationCourseCategory,
                attributes: ['name']
            }
        });

        if (!course) {
            return res.status(404).json({ error: `Course with id: ${courseId} not found`});
        }

        const response = {
            id: course.id,
            name: course.name,
            publishedDate: course.publishedDate,
            enabled: course.enabled,
            category: course.MarbustEducationCourseCategory.name,
            categoryId: course.categoryId
        };

        res.status(200).json(response);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Internal server error', serverReport: error});
    }
};

exports.getAllCourses = async (req, res) => {
    try {
        const courses = await MarbustEducationCourse.findAll({
            include: {
                model: MarbustEducationCourseCategory,
                attributes: ['name']
            }
        });

        if (courses.length === 0) {
            return res.status(404).json({ error: 'No courses found' });
        }

        const response = courses.map(course => ({
            id: course.id,
            name: course.name,
            publishedDate: course.publishedDate,
            enabled: course.enabled,
            category: course.MarbustEducationCourseCategory.name,
            categoryId: course.categoryId
        }));

        res.status(200).json(response);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Internal server error', serverReport: error });
    }
};