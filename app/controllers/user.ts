import {Request, Response} from 'express';

export const allUsers = async (req: Request, res: Response) => {
    res.json([]);
};

export const getUser = async (req: Request, res: Response) => {
    res.json({user_id: req.params.id});
};